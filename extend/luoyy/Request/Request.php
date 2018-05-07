<?php
namespace luoyy\Request;

use luoyy\Request\Core;

class Request
{
    private static $Request;

    public static function __callStatic($method, $args)
    {
        if (is_null(self::$Request)) {
            self::$Request = new Core();
        }
        return call_user_func_array([self::$Request, $method], $args);
    }
}