<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\AuthGroup;
use app\common\model\AuthRule;
use think\Request;

/**
 * 权限组
 * Class AuthGroup
 * @package app\admin\controller
 */
class AuthGroupController extends AdminBaseController
{
    /**
     * 权限组
     * @return mixed
     */
    public function index()
    {
        return view('auth_group/index')
            ->assign('auth_group_list', AuthGroup::paginate(15, false));
    }

    /**
     * 添加权限组
     * @return mixed
     */
    public function add()
    {

        return view('auth_group/add');
    }

    /**
     * 保存权限组
     */
    public function save(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'AuthGroupSave');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new AuthGroup)->allowField(true)->isUpdate(false)->save($data) !== false) {
                    return $this->success('保存成功');
                } else {
                    return $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑权限组
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return view('auth_group/edit')->assign('auth_group', AuthGroup::where(['id' => $id])->find());
    }

    /**
     * 更新权限组
     * @param $id
     */
    public function update(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'AuthGroupUpdate');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ($data['id'] == 1 && $data['status'] != 1) {
                    return $this->error('超级管理组不可禁用');
                }
                if ((new AuthGroup)->allowField(true)->isUpdate(true)->save($data, ['id' => $data['id']]) !== false) {
                    return $this->success('更新成功');
                } else {
                    return $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除权限组
     * @param $id
     */
    public function delete($id)
    {
        if ($id == 1) {
            return $this->error('超级管理组不可删除');
        }
        if (AuthGroup::destroy($id)) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }

    /**
     * 授权
     * @param $id
     * @return mixed
     */
    public function auth($id)
    {
        return view('auth_group/auth')->assign('id', $id);
    }

    /**
     * AJAX获取规则数据
     * @param $id
     * @return mixed
     */
    public function get_json($id)
    {
        $auth_group_data = AuthGroup::where(['id' => $id])->find();
        $auth_rule_list = AuthRule::field('id,pid,title,name')->select()->toArray();

        foreach ($auth_rule_list as &$value) {
            $auth_group_data->hasPermission($value['name']) && $value['checked'] = true;
        }

        return json($auth_rule_list);
    }

    /**
     * 更新权限组规则
     * @param $id
     * @param $auth_rule_ids
     */
    public function update_auth_group_rule(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'UpdateAuthGroupRule');
            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                $auth_group = AuthGroup::where(['id' => $data['id']])->find();
                if (empty($auth_group)) {
                    return $this->error('角色获取失败');
                }
                if ($auth_group->savePermissions($data['auth_rule_ids'])) {
                    return $this->success('授权成功');
                } else {
                    return $this->error('授权失败');
                }
            }
        }
    }
}
