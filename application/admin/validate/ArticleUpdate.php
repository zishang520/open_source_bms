<?php
namespace app\admin\validate;

use think\Validate;

class ArticleUpdate extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'cid'   => 'require',
        'title' => 'require',
        'sort'  => 'require|number'
    ];

    protected $message = [
        'id.require' => '文章ID不能为空',
        'id.number' => '文章ID格式错误',
        'cid.require'   => '请选择所属栏目',
        'title.require' => '请输入标题',
        'sort.require'  => '请输入排序',
        'sort.number'   => '排序只能填写数字'
    ];
}