<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use think\Request;
use think\facade\Session;

/**
 * 修改密码
 * Class ChangePassword
 * @package app\admin\controller
 */
class ChangePasswordController extends AdminBaseController
{
    /**
     * 修改密码
     * @return mixed
     */
    public function index()
    {
        return view('system/change_password');
    }

    /**
     * 更新密码
     */
    public function update_password(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'UpdatePassword');
            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if (self::$admin_user->verifyPassword($data['old_password'])) {
                    self::$admin_user->password = $data['password'];
                    if (self::$admin_user->isUpdate(true)->save() !== false) {
                        Session::delete('admin_id');
                        Session::delete('admin_name');
                        return $this->success('修改成功', '/admin/Login/index');
                    } else {
                        return $this->error('修改失败');
                    }
                } else {
                    return $this->error('原密码不正确');
                }
            }
        }
    }
}
