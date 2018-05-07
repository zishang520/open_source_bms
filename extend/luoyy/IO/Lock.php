<?php

namespace luoyy\IO;

/**
 * IO流程锁
 */
class Lock
{
    /**
     * [work 同步锁]
     * @DateTime  2017-08-16T16:28:47+0800
     * @param     [type]                   $func      [description]
     * @return    [type]                              [description]
     */
    public static function work(callable $func)
    {
        $result = null;
        $fp = fopen(__FILE__, "r");
        try {
            if (flock($fp, LOCK_EX)) {
                try {
                    $result = call_user_func($func);
                } finally {
                    flock($fp, LOCK_UN);
                }
            }
        } finally {
            fclose($fp);
            return $result;
        }
    }

    /**
     * [asyncWork 异步锁]
     * @DateTime  2017-08-16T16:35:47+0800
     * @param     callable                  $func      [description]
     * @param     callable                  $func2     [description]
     * @return    [type]                              [description]
     */
    public static function asyncWork(callable $func, callable $func2)
    {
        $result = null;
        $fp = fopen(__FILE__, "r");
        try {
            if (flock($fp, LOCK_EX | LOCK_NB)) {
                try {
                    $result = call_user_func($func);
                } finally {
                    flock($fp, LOCK_UN);
                }
            } else {
                $result = call_user_func($func2);
            }
        } finally {
            fclose($fp);
            return $result;
        }
    }
}
