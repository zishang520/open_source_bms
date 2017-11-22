<?php

namespace app\common\model;

use luoyy\Entrust\EntrustPermission;

/**
 * This is the model class for table "os_auth_rule".
 *
 * @property string $id
 * @property string $name
 * @property string $title
 * @property integer $type
 * @property integer $status
 * @property integer $pid
 * @property string $icon
 * @property integer $sort
 * @property string $condition
 */
class AuthRule extends EntrustPermission
{
    /**
     * 获取层级缩进列表数据
     * @return array
     */
    public static function getLevelList()
    {
        return array2level(self::order(['sort' => 'DESC'])->select()->toArray());
    }
}
