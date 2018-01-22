<?php
namespace app\common\controller;

use app\common\model\Nav;
use app\common\model\Slide;
use app\common\model\System;
use think\Controller;
use think\facade\Cache;

class HomeBaseController extends Controller
{

    protected function initialize()
    {
        parent::initialize();
        $this->getSystem();
        $this->getNav();
        $this->getSlide();
    }

    /**
     * 获取站点信息
     */
    protected function getSystem()
    {
        $site_config = Cache::tag('site_config')->remember('system', function () {
            $site_config = System::field('value')->where('name', 'site_config')->find();
            return !empty($site_config) ? $site_config['value'] : [];
        });
        $this->assign($site_config);
    }

    /**
     * 获取前端导航列表
     */
    protected function getNav()
    {
        $nav = Cache::tag('nav')->remember('navs', function () {
            $nav = Nav::where(['status' => 1])->order(['sort' => 'ASC'])->select()->toArray();
            return !empty($nav) ? array2tree($nav) : [];
        });
        $this->assign('nav', $nav);
    }

    /**
     * 获取前端轮播图
     */
    protected function getSlide()
    {
        $slide = Cache::tag('slide')->remember('slides', function () {
            return Slide::where(['status' => 1, 'cid' => 1])->order(['sort' => 'DESC'])->select()->toArray();
        });
        $this->assign('slide', $slide);
    }
}
