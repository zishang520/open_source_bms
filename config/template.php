<?php
// +----------------------------------------------------------------------
// | 模板设置
// +----------------------------------------------------------------------

return [
    // 模板引擎类型 支持 php think 支持扩展
    'type' => 'Blade',
    // 视图基础目录（集中式）
    'view_base' => Env::get('root_path') . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR,
    // 模板起始路径
    'view_path' => Env::get('root_path') . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR,
    // 模板文件名分隔符
    'view_depr' => DIRECTORY_SEPARATOR,
    // 模板缓存目录
    'view_cache_path' => Env::get('runtime_path') . 'temp' . DIRECTORY_SEPARATOR,
    // 模板文件后缀
    'view_suffix' => 'blade.php',
    'cache' => [
        'cache_subdir' => false,
        'prefix' => '',
    ],
];
