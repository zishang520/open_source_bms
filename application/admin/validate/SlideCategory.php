<?php
namespace app\admin\validate;

use think\Validate;

class SlideCategory extends Validate
{
    protected $rule = [
        'name' => 'require',
    ];

    protected $message = [
        'name.require' => '请输入分类名称',
    ];
}
