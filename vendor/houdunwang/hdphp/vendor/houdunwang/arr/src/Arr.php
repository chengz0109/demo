<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDCMS framework]
 * |      Site: www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace houdunwang\arr;

use houdunwang\arr\build\Base;

/**
 * 数组管理
 * Class Arr
 *
 * @package hdphp\arr
 * @author  向军
 */
class Arr
{
    protected $link;

    //更改缓存驱动
    protected function driver()
    {
        $this->link = new Base();

        return $this;
    }

    public function __call($method, $params)
    {
        if (is_null($this->link)) {
            $this->driver();
        }
        if (method_exists($this->link, $method)) {
            return call_user_func_array([$this->link, $method], $params);
        }
    }

    public static function single()
    {
        static $link;
        if (is_null($link)) {
            $link = new static();
        }

        return $link;
    }

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([static::single(), $name], $arguments);
    }
}