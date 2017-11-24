<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 轮播图验证器
 * Class Slide
 * @package app\admin\validate
 */
class SlideUpdate extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'cid' => 'require',
        'name' => 'require',
        'sort' => 'require|number',
    ];

    protected $message = [
        'id.require' => '轮播图ID不能为空',
        'id.number' => '轮播图ID格斯错误',
        'cid.require' => '请选择所属分类',
        'name.require' => '请输入名称',
        'sort.require' => '请输入排序',
        'sort.number' => '排序只能填写数字',
    ];
}
