<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\User;
use think\Request;

/**
 * 用户管理
 * Class AdminUser
 * @package app\admin\controller
 */
class UserController extends AdminBaseController
{
    /**
     * 用户管理
     * @param string $keyword
     * @param int    $page
     * @return mixed
     */
    public function index(Request $request)
    {
        $map = [];
        $search = ['keyword' => ''];
        $params = array_filter($request->get() + $search, function ($k) use ($search) {
            return in_array($k, array_keys($search));
        }, ARRAY_FILTER_USE_KEY);

        if ($params['keyword'] != '') {
            $map['username|mobile|email'] = ['like', "%{$params['keyword']}%"];
        }
        $user_list = User::where($map)
            ->order('id DESC')
            ->paginate(15, false, ['query' => $params]);
        return view('user/index')
            ->assign('user_list', $user_list)
            ->assign('search', $params);
    }

    /**
     * 添加用户
     * @return mixed
     */
    public function add()
    {
        return view('user/add');
    }

    /**
     * 保存用户
     */
    public function save(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'User');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new User)->allowField(true)->isUpdate(true)->save($data)) {
                    return $this->success('保存成功');
                } else {
                    return $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑用户
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $user = User::where(['id' => $id])->find();
        if (empty($user)) {
            return $this->error('获取用户信息失败');
        }
        return view('user/edit')->assign('user', $user);
    }

    /**
     * 更新用户
     * @param $id
     */
    public function update(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'UserUpdate');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                $user = User::where(['id' => $data['id']])->find();
                if (empty($user)) {
                    return $this->error('用户信息获取失败');
                }
                $user->username = $data['username'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->status = $data['status'];
                if (!empty($data['password']) && !empty($data['confirm_password'])) {
                    $user->password = $data['password'];
                }
                if ($user->isUpdate(true)->save() !== false) {
                    return $this->success('更新成功');
                } else {
                    return $this->error('更新用户信息失败！');
                }
            }
        }
    }

    /**
     * 删除用户
     * @param $id
     */
    public function delete($id)
    {
        if (User::destroy($id)) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}
