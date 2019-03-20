<?php
/**
 * Desc: 时间Abstract
 * User: baagee
 * Date: 2019/3/20
 * Time: 下午10:28
 */

namespace BaAGee\Event\Base;

/**
 * Class EventAbstract
 * @package BaAGee\Event\Base
 */
abstract class EventAbstract
{
    use ProhibitNewClone;

    /**
     * @var array
     */
    protected static $listenEvents = [];
}
