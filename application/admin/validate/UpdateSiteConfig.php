<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 友情链接验证器
 * Class Link
 * @package app\admin\validate
 */
class UpdateSiteConfig extends Validate
{
    protected $rule = [
        'site_config' => 'require|array',
    ];

    protected $message = [
        'site_config.require' => '站点信息不能为空',
        'site_config.array' => '站点信息必须是一个数组',
    ];
}
