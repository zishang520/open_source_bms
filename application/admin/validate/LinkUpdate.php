<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 友情链接验证器
 * Class Link
 * @package app\admin\validate
 */
class LinkUpdate extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'name' => 'require',
    ];

    protected $message = [
        'id.require' => '链接ID不能为空',
        'id.number' => '链接ID格斯错误',
        'name.require' => '请输入名称',
    ];
}
