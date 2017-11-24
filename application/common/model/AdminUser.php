<?php

namespace app\common\model;

use app\common\model\AuthGroup;
use app\common\model\AuthGroupAccess;
use luoyy\Entrust\Traits\EntrustUserTrait;
use org\PasswordHash;
use think\Config;
use think\Model;

/**
 * This is the model class for table "os_admin_user".
 */
class AdminUser extends Model
{

    use EntrustUserTrait;

    protected $insert = ['create_time'];

    /**
     * 创建时间
     * @return bool|string
     */
    protected function setCreateTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }
    /**
     * [setPasswordAttr 设置密码]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2017-11-18T17:32:26+0800
     * @copyright (c)                      ZiShang520 All           Rights Reserved
     * @param     [type]                   $val       [description]
     */
    public function setPasswordAttr($val)
    {
        return (new PasswordHash(8, false))->HashPassword($val . Config::get('salt'));
    }
    /**
     * [verifyPassword 验证密码]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2017-11-18T17:32:17+0800
     * @copyright (c)                      ZiShang520 All           Rights Reserved
     * @param     [type]                   $password  [description]
     * @return    [type]                              [description]
     */
    public function verifyPassword($password)
    {
        return (new PasswordHash(8, false))->CheckPassword($password . Config::get('salt'), $this->getAttr('password'));
    }
    /**
     * [authGroupAccess 一对一关联]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2017-11-18T17:33:26+0800
     * @copyright (c)                      ZiShang520    All Rights Reserved
     * @return    [type]                   [description]
     */
    public function authGroupAccess()
    {
        return $this->hasOne(AuthGroupAccess::class, 'uid');
    }
    public function getGroupIdAttr()
    {
        return $this->authGroupAccess->group_id;
    }
}
