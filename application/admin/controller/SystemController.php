<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\System;
use think\facade\Env ;
use think\Request;

/**
 * 系统配置
 * Class System
 * @package app\admin\controller
 */
class SystemController extends AdminBaseController
{
    /**
     * 站点配置
     */
    public function site_config()
    {
        return view('system/site_config')
            ->assign('site_config', System::field('value')->where('name', 'site_config')->find()->value);
    }

    /**
     * 更新配置
     */
    public function update_site_config(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'UpdateSiteConfig');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new System)->updateOrCreate(['name' => 'site_config'], ['value' => $data['site_config']]) !== false) {
                    return $this->success('提交成功');
                } else {
                    return $this->error('提交失败');
                }
            }
        }
    }

    /**
     * 清除缓存
     */
    public function clear()
    {
        if (delete_dir_file(Env::get('runtime_path') . 'cache/') || delete_dir_file(Env::get('runtime_path') . 'temp/')) {
            return $this->success('清除缓存成功');
        } else {
            return $this->error('清除缓存失败');
        }
    }
}
