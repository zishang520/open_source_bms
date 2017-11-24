<?php
namespace app\admin\controller;

use app\common\model\AdminUser as AdminUserModel;
use think\Controller;
use think\Request;
use think\Session;

/**
 * 后台登录
 * Class Login
 * @package app\admin\controller
 */
class LoginController extends Controller
{
    /**
     * 后台登录
     * @return mixed
     */
    public function index()
    {
        return view('login/index');
    }

    /**
     * 登录验证
     * @return string
     */
    public function login(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->only(['username', 'password', 'verify']);
            $validate_result = $this->validate($data, 'Login');
            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                $adminUser = AdminUserModel::get(['username' => $data['username']]);
                if (!empty($adminUser) && $adminUser->verifyPassword($data['password'])) {
                    if ($adminUser->status != 1) {
                        return $this->error('当前用户已禁用');
                    } else {
                        Session::set('admin_id', $adminUser['id']);
                        Session::set('admin_name', $adminUser['username']);
                        $adminUser->last_login_ip = $request->ip();
                        $adminUser->last_login_time = date('Y-m-d H:i:s');
                        $adminUser->save();
                        return $this->success('登录成功', 'admin/index/index');
                    }
                } else {
                    return $this->error('用户名或密码错误');
                }
            }
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Session::delete('admin_id');
        Session::delete('admin_name');
        return $this->success('退出成功', '/admin/Login/index');
    }

    /**
     * [_empty 空方法]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2017-11-18T17:45:32+0800
     * @copyright (c)                      ZiShang520    All Rights Reserved
     * @return    [type]                   [description]
     */
    public function _empty()
    {
        return $this->error('访问的页面不存在');
    }
}
