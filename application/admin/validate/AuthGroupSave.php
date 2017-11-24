<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 管理员验证器
 * Class AdminUser
 * @package app\admin\validate
 */
class AuthGroupSave extends Validate
{
    protected $rule = [
        'name' => 'require|unique:auth_group',
        'title' => 'require',
        'status' => 'require',
    ];

    protected $message = [
        'name.require' => '请输入权限标识',
        'name.unique' => '权限标识已经存在',
        'title.require' => '权限名称不能为空',
        'status.require' => '请选择状态',
    ];
}
