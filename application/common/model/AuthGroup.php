<?php

namespace app\common\model;

use luoyy\Entrust\EntrustRole;

/**
 * This is the model class for table "os_auth_group".
 *
 * @property string $id
 * @property string $title
 * @property integer $status
 * @property string $rules
 */
class AuthGroup extends EntrustRole
{
    /**
     * [$insert 自动插入]
     * @var array
     */
    protected $insert = ['created_at'];
    /**
     * [$update 更新]
     * @var [type]
     */
    protected $update = ['updated_at'];
    /**
     * 创建时间
     * @return bool|string
     */
    protected function setCreatedAtAttr()
    {
        return date('Y-m-d H:i:s');
    }
    /**
     * [setUpdatedAtAttr 自动插入时间]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2017-08-11T14:46:42+0800
     * @copyright (c)                      ZiShang520 All Rights Reserved
     */
    protected function setUpdatedAtAttr()
    {
        return date('Y-m-d H:i:s');
    }
}
