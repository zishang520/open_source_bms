<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 管理员验证器
 * Class AdminUser
 * @package app\admin\validate
 */
class AuthGroupUpdate extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'name' => 'require|unique:auth_group',
        'title' => 'require',
        'status' => 'require',
    ];

    protected $message = [
        'id.require' => '权限编号不能为空',
        'id.number' => '权限编号错误',
        'name.require' => '请输入权限标识',
        'name.unique' => '权限标识已经存在',
        'title.require' => '权限名称不能为空',
        'status.require' => '请选择状态',
    ];
}
