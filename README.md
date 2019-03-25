# php-event
PHP Event Library

### php事件定义与触发

### 安装
php composer require php-event

### 使用示例：
```php 
include_once __DIR__ . '/../vendor/autoload.php';

// 匿名函数 不传参数
// 重复事件
\BaAGee\Event\Event::listen('event1', function () {
    echo 'event1' . PHP_EOL;
    return 'return event1';
});
// 第三个参数为true 一次性事件 触发后就删除，下次就不会再次触发了 
\BaAGee\Event\Event::listen('event1', function () {
    echo 'once event1' . PHP_EOL;
    return 'return once event1';
}, true);
// 触发event1事件
$res = \BaAGee\Event\Event::trigger('event1');
var_dump($res);
$res = \BaAGee\Event\Event::trigger('event1');
var_dump($res);
```
输出结果：
```
event1
once event1
/Users/baagee/PhpstormProjects/github/php-event/tests/test1.php:23:
array(2) {
  [0] =>
  string(13) "return event1"
  [1] =>
  string(18) "return once event1"
}
event1
/Users/baagee/PhpstormProjects/github/php-event/tests/test1.php:25:
array(1) {
  [0] =>
  string(13) "return event1"
}
```

### 详细示例代码：tests目录