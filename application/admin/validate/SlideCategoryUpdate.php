<?php
namespace app\admin\validate;

use think\Validate;

class SlideCategoryUpdate extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'name' => 'require',
    ];

    protected $message = [
        'id.require' => '分类ID不能为空',
        'id.number' => '分类ID格斯错误',
        'name.require' => '请输入分类名称',
    ];
}
