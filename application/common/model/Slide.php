<?php
namespace app\common\model;

use think\Cache;
use think\Model;

class Slide extends Model
{
    public static function init()
    {
        parent::init();
        static::afterInsert(function ($role) {
            Cache::rm('slides');
            return true;
        });
        static::afterUpdate(function ($role) {
            Cache::rm('slides');
            return true;
        });
        static::afterWrite(function ($role) {
            Cache::rm('slides');
            return true;
        });
        static::afterDelete(function ($role) {
            Cache::rm('slides');
            return true;
        });
    }
}
