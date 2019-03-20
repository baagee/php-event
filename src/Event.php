<?php
/**
 * Desc: Event
 * User: baagee
 * Date: 2019/3/20
 * Time: 下午10:26
 */

namespace BaAGee\Event;

use BaAGee\Event\Base\EventAbstract;
use BaAGee\Event\Base\EventInterface;

/**
 * Class Event
 * @package BaAGee\Event
 */
class Event extends EventAbstract implements EventInterface
{
    /**
     * 添加监听时间
     * @param string   $event    事件名字
     * @param callback $callback 处理函数
     * @param bool     $once     是否触发一次
     * @return bool
     */
    public static function listen(string $event, callable $callback, bool $once = false)
    {
        if (!is_callable($callback)) {
            return false;
        }
        self::$listenEvents[$event][] = ['callback' => $callback, 'once' => $once];
        return true;
    }

    /**
     * 删除事件
     * @param string $event 事件名字
     * @param null   $index 相同事件名字下的
     */
    public static function remove($event, $index = null)
    {
        if (is_null($index)) {
            unset(self::$listenEvents[$event]);
        } else {
            unset(self::$listenEvents[$event][$index]);
        }
    }

    /**
     * 触发器
     * @return bool|mixed
     */
    public static function trigger()
    {
        if (!func_num_args()) {
            return false;
        }
        //获取方法的参数
        $args = func_get_args();
        // 提取事件名字
        $event = array_shift($args);
        if (!isset(self::$listenEvents[$event])) {
            return false;
        }
        $res = [];
        foreach ((array)self::$listenEvents[$event] as $index => $listen) {
            $callback = $listen['callback'];
            if ($listen['once']) {
                // 如果事件监听一次 一次触发就删除
                self::remove($event, $index);
            }
            // 调用监听处理函数
            $res[$index] = call_user_func_array($callback, $args);
        }
        return $res;
    }
}
