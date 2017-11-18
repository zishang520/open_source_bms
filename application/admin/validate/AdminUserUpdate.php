<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 管理员验证器
 * Class AdminUser
 * @package app\admin\validate
 */
class AdminUserUpdate extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'username' => 'require|unique:admin_user',
        'password' => 'confirm:confirm_password',
        'confirm_password' => 'confirm:password',
        'status' => 'require',
        'group_id' => 'require|array',
    ];

    protected $message = [
        'id.require' => 'ID不能为空',
        'id.array' => 'ID格式不对',
        'username.require' => '请输入用户名',
        'username.unique' => '用户名已存在',
        'password.confirm' => '两次输入密码不一致',
        'confirm_password.confirm' => '两次输入密码不一致',
        'status.require' => '请选择状态',
        'group_id.require' => '请选择所属权限组',
        'group_id.array' => '权限组格式不对',
    ];
}
