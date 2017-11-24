<?php
namespace app\common\model;

use org\PasswordHash;
use think\Config;
use think\Model;

class User extends Model
{
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
        return (new PasswordHash(8, false))->HashPassword(Config::get('salt') . $val);
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
        return (new PasswordHash(8, false))->CheckPassword(Config::get('salt') . $password, $this->getAttr('password'));
    }
}
