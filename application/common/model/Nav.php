<?php
namespace app\common\model;

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
}