<?php
/**
 * Desc:
 * User: baagee
 * Date: 2019/3/20
 * Time: 下午10:36
 */
include_once __DIR__ . '/../vendor/autoload.php';

// 匿名函数 不传参数
// 重复事件
\BaAGee\Event\Event::listen('event1', function () {
    echo 'event1' . PHP_EOL;
    return 'return event1';
});
// 一次性事件 触发后就删除，下次就不会再次触发了
\BaAGee\Event\Event::listen('event1', function () {
    echo 'once event1' . PHP_EOL;
    return 'return once event1';
}, true);
// 触发event1事件
$res = \BaAGee\Event\Event::trigger('event1');
var_dump($res);
$res = \BaAGee\Event\Event::trigger('event1');
var_dump($res);
// 匿名函数传参数
\BaAGee\Event\Event::listen('say', function ($name = '') {
    echo "I am $name" . PHP_EOL;
}, true);
\BaAGee\Event\Event::trigger('say', 'hello'); // 输出 I am hello
\BaAGee\Event\Event::trigger('say', 'world'); // not run

// 对象方法
class Foo
{
    public function bar()
    {
        echo __METHOD__ . PHP_EOL;
    }

    public function test($params)
    {
        echo __METHOD__ . '||||' . json_encode(func_get_args(), JSON_UNESCAPED_UNICODE) . PHP_EOL;
        var_dump($params);
    }
}

$foo = new Foo();

\BaAGee\Event\Event::listen('Foo::bar', [$foo, 'bar']);
\BaAGee\Event\Event::trigger('Foo::bar');

\BaAGee\Event\Event::listen('Foo::test', [$foo, 'test']);
\BaAGee\Event\Event::trigger('Foo::test', ['name' => '多喝水的', 'sex' => 12]);
\BaAGee\Event\Event::trigger('Foo::test', '123456');

// 静态函数

class Bar
{
    public static function foo($params = '')
    {
        echo __METHOD__ . PHP_EOL;
        var_dump($params);
    }
}

\BaAGee\Event\Event::listen('Bar::foo', ['Bar', 'foo']);
\BaAGee\Event\Event::trigger('Bar::foo', 'ppp');
\BaAGee\Event\Event::listen('Bar::foo', 'Bar::foo');
\BaAGee\Event\Event::trigger('Bar::foo', '9090');

// 函数
function bar()
{
    echo __FUNCTION__ . PHP_EOL;
}

\BaAGee\Event\Event::listen('bar', 'bar');
\BaAGee\Event\Event::trigger('bar');