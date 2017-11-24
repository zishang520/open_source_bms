<?php
namespace app\admin\validate;

use think\Validate;

class CategoryUpdate extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'pid' => 'require',
        'name' => 'require',
        'sort' => 'require|number',
    ];

    protected $message = [
        'id.require' => '栏目id不能为空',
        'id.number' => '栏目id必须为数字',
        'pid.require' => '请选择上级栏目',
        'name.require' => '请输入栏目名称',
        'sort.require' => '请输入排序',
        'sort.number' => '排序只能填写数字',
    ];
}
