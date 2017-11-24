<?php
namespace app\common\controller;

use app\common\model\AdminUser;
use app\common\model\AuthRule;
use think\Controller;
use think\Loader;
use think\Session;
use think\View;

/**
 * 后台公用基础控制器
 * Class AdminBase
 * @package app\common\controller
 */
class AdminBaseController extends Controller
{

    protected static $admin_user = null;

    protected function _initialize()
    {
        parent::_initialize();

        $this->checkAuth();
        $this->getMenu();

        // 输出当前请求控制器（配合后台侧边菜单选中状态）
        View::share('module', Loader::parseName($this->request->module()));
        View::share('controller', Loader::parseName($this->request->controller()));
    }

    /**
     * 权限检查
     * @return bool
     */
    protected function checkAuth()
    {
        if (!Session::has('admin_id')) {
            return $this->redirect('admin/login/index');
        }

        $module = $this->request->module();
        $controller = $this->request->controller();
        $action = $this->request->action();
        self::$admin_user = AdminUser::where(['id' => Session::get('admin_id')])->find();
        // 排除权限
        $not_check = ['admin/Index/index', 'admin/AuthGroup/getjson', 'admin/System/clear'];

        if (!in_array($module . '/' . $controller . '/' . $action, $not_check)) {
            if (!(self::$admin_user->can($module . '/' . $controller . '/' . $action)) && self::$admin_user->id != 1) {
                return $this->error('没有权限');
            }
        }
    }

    /**
     * 获取侧边栏菜单
     */
    protected function getMenu()
    {
        $menu = [];
        $module = $this->request->module();
        $auth_rule_list = AuthRule::where('status', 1)->where('name', 'like', $module . '/%')->order(['sort' => 'DESC', 'id' => 'ASC'])->select();
        foreach ($auth_rule_list->toArray() as $value) {
            if (self::$admin_user->can($value['name']) || self::$admin_user->id == 1) {
                array_push($menu, $value);
            }
        }
        $menu = !empty($menu) ? array2tree($menu) : [];
        View::share('menu', $menu);
    }

    public function _empty()
    {
        return $this->error('访问的页面不存在');
    }
}
