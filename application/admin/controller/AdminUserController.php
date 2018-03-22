<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\AdminUser;
use app\common\model\AuthGroup;
use think\Request;

/**
 * 管理员管理
 * Class AdminUser
 * @package app\admin\controller
 */
class AdminUserController extends AdminBaseController
{
    /**
     * 管理员管理
     * @return mixed
     */
    public function index()
    {
        return view('admin_user/index')
            ->assign('admin_user_list', AdminUser::paginate(15, false));
    }

    /**
     * 添加管理员
     * @return mixed
     */
    public function add()
    {
        return view('admin_user/add')
            ->assign('auth_group_list', AuthGroup::all());
    }

    /**
     * 保存管理员
     * @param $group_id
     */
    public function save(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'AdminUserAdd');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                $adminUserModel = new AdminUser();
                if ($adminUserModel->allowField(true)->save($data) !== false) {
                    $adminUserModel->saveRole($data['group_id']);
                    return $this->success('保存成功');
                } else {
                    return $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑管理员
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $admin_user = AdminUser::where(['id' => $id])->find();
        $auth_group_list = AuthGroup::all();
        return view('admin_user/edit')
            ->assign('admin_user', $admin_user)
            ->assign('has_roles', array_map(function ($value) {
                return $value['id'];
            }, $admin_user->roles->toArray()))
            ->assign('roles', AuthGroup::all());
    }

    /**
     * 更新管理员
     * @param $id
     * @param $group_id
     */
    public function update(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'AdminUserUpdate');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                $admin_user = AdminUser::where(['id' => $data['id']])->find();
                if (empty($admin_user)) {
                    return $this->error('用户信息获取失败');
                }
                $admin_user->username = $data['username'];
                $admin_user->status = $data['status'];
                if (!empty($data['password']) && !empty($data['confirm_password'])) {
                    $admin_user->password = $data['password'];
                }
                if ($admin_user->isUpdate(true)->save() !== false) {
                    $admin_user->saveRole($data['group_id']);
                    return $this->success('更新成功');
                } else {
                    return $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除管理员
     * @param $id
     */
    public function delete($id)
    {
        if ($id == 1) {
            return $this->error('默认管理员不可删除');
        }
        $admin_user = AdminUser::where(['id' => $id])->find();
        if (empty($admin_user)) {
            return $this->error('管理员信息获取失败');
        }
        if ($admin_user->delete()) {
            $admin_user->detachRoles();
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}
