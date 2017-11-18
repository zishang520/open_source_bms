<?php
namespace app\admin\controller;

use app\common\model\User as UserModel;
use app\common\controller\AdminBaseController;
use think\Config;
use think\Db;

/**
 * 用户管理
 * Class AdminUser
 * @package app\admin\controller
 */
class UserController extends AdminBaseController
{
    protected $userModel;

    protected function _initialize()
    {
        parent::_initialize();
        $this->userModel = new UserModel();
    }

    /**
     * 用户管理
     * @param string $keyword
     * @param int    $page
     * @return mixed
     */
    public function index($keyword = '', $page = 1)
    {
        $map = [];
        if ($keyword) {
            $map['username|mobile|email'] = ['like', "%{$keyword}%"];
        }
        $user_list = $this->userModel->where($map)->order('id DESC')->paginate(15, false, ['page' => $page]);

        return $this->fetch('index', ['user_list' => $user_list, 'keyword' => $keyword]);
    }

    /**
     * 添加用户
     * @return mixed
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 保存用户
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'User');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                $data['password'] = md5($data['password'] . Config::get('salt'));
                if ($this->userModel->allowField(true)->save($data)) {
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
        $user = $this->userModel->find($id);

        return $this->fetch('edit', ['user' => $user]);
    }

    /**
     * 更新用户
     * @param $id
     */
    public function update($id)
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'User');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                $user           = $this->userModel->find($id);
                $user->id       = $id;
                $user->username = $data['username'];
                $user->mobile   = $data['mobile'];
                $user->email    = $data['email'];
                $user->status   = $data['status'];
                if (!empty($data['password']) && !empty($data['confirm_password'])) {
                    $user->password = md5($data['password'] . Config::get('salt'));
                }
                if ($user->save() !== false) {
                    return $this->success('更新成功');
                } else {
                    return $this->error('更新失败');
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
        if ($this->userModel->destroy($id)) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}