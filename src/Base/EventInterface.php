<?php
/**
 * Desc: 事件接口
 * User: baagee
 * Date: 2019/3/20
 * Time: 下午10:30
 */

namespace BaAGee\Event\Base;

/**
 * Interface EventInterface
 * @package BaAGee\Event\Base
 */
interface EventInterface
{
    /**
     * @param string   $event
     * @param callable $callback
     * @param bool     $once
     * @return mixed
     */
    public static function listen(string $event, callable $callback, bool $once = false);

    /**
     * @param      $event
     * @param null $index
     * @return mixed
     */
    public static function remove($event, $index = null);

    /**
     * @return mixed
     */
    public static function trigger();
}
