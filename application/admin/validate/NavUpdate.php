<?php
namespace app\admin\validate;

use think\Validate;

class NavUpdate extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'pid' => 'require',
        'name' => 'require',
        'sort' => 'require|number',
    ];

    protected $message = [
        'id.require' => '导航ID不能为空',
        'id.number' => '导航ID格式错误',
        'pid.require' => '请选择上级导航',
        'name.require' => '请输入导航名称',
        'sort.require' => '请输入排序',
        'sort.number' => '排序只能填写数字',
    ];
}
