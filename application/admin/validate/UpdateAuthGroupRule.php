<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 友情链接验证器
 * Class Link
 * @package app\admin\validate
 */
class UpdateAuthGroupRule extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'auth_rule_ids' => 'require|array',
    ];

    protected $message = [
        'id.require' => '角色编号不能为空',
        'id.number' => '角色编号格式不正确',
        'auth_rule_ids.require' => '权限不能为空',
        'id.array' => '权限格式不正确',
    ];
}
