<?php
namespace app\common\model;

use think\Cache;
use think\Model;

class Nav extends Model
{
    /**
     * 获取层级缩进列表数据
     * @return array
     */
    public static function getLevelList()
    {
        return array2level(self::order(['sort' => 'DESC', 'id' => 'ASC'])->select()->toArray());
    }
    public static function init()
    {
        parent::init();
        static::afterInsert(function ($role) {
            Cache::rm('navs');
            return true;
        });
        static::afterUpdate(function ($role) {
            Cache::rm('navs');
            return true;
        });
        static::afterWrite(function ($role) {
            Cache::rm('navs');
            return true;
        });
        static::afterDelete(function ($role) {
            Cache::rm('navs');
            return true;
        });
    }
}
