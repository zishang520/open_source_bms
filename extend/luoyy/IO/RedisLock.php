<?php

namespace luoyy\IO;

/**
 * IO流程锁
 */
class RedisLock
{
    private $redis;

    private $name;

    private $timeout;

    public function __construct($redisApi, $name, $timeout = 3)
    {
        $this->redis = $redisApi;
        $this->name = $name;
        $this->timeout = $timeout;
    }
    /**
     * [asyncWork 异步锁]
     * @DateTime  2017-08-16T16:35:47+0800
     * @param     callable                  $func      [description]
     * @param     callable                  $func2     [description]
     * @return    [type]                              [description]
     */
    public function asyncWork(callable $func, callable $func2)
    {
        $result = null;
        if ($this->redis->setnx($this->name, 1)) {
            try {
                $result = call_user_func($func);
            } finally {
                // 释放锁
                $this->redis->del($this->name);
            }
        } else {
            try {
                // 防止死锁
                $result = call_user_func($func2);
            } finally {
                if ($this->redis->ttl($this->name) == -1) {
                    $this->redis->expire($this->name, $this->timeout);
                }
            }
        }
        return $result;
    }
}
