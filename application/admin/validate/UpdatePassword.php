<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 管理员验证器
 * Class AdminUser
 * @package app\admin\validate
 */
class UpdatePassword extends Validate
{
    protected $rule = [
        'password' => 'confirm:confirm_password',
        'confirm_password' => 'confirm:password',
    ];

    protected $message = [
        'password.confirm' => '两次输入密码不一致',
        'confirm_password.confirm' => '两次输入密码不一致',
    ];
}
