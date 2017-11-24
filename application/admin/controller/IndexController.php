<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use think\Cache;
use think\Config;
use think\Db;
use think\Request;

/**
 * 后台首页
 * Class Index
 * @package app\admin\controller
 */
class IndexController extends AdminBaseController
{
    /**
     * 首页
     * @return mixed
     */
    public function index(Request $request)
    {
        $config = [
            'url' => $request->server('http_host'),
            'document_root' => $request->server('document_root'),
            'server_os' => PHP_OS,
            'server_port' => $request->server('server_port'),
            'server_soft' => $request->server('server_software'),
            'php_version' => PHP_VERSION,
            'mysql_version' => Cache::remember('_DB', function () {
                return Db::query("SELECT VERSION() as version")[0]['version'];
            }, Config::get('cache.ttl', 60)),
            'max_upload_size' => ini_get('upload_max_filesize'),
        ];
        return $this->fetch('index', ['config' => $config]);
    }
}
