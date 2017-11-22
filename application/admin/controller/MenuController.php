<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\AuthRule;

/**
 * 后台菜单
 * Class Menu
 * @package app\admin\controller
 */
class MenuController extends AdminBaseController
{
    /**
     * 后台菜单
     * @return mixed
     */
    public function index()
    {
        return view('menu/index')
            ->assign('admin_menu_level_list', AuthRule::getLevelList());
    }

    /**
     * 添加菜单
     * @param string $pid
     * @return mixed
     */
    public function add($pid = '')
    {
        return view('menu/add')
            ->assign('pid', $pid)
            ->assign('admin_menu_level_list', AuthRule::getLevelList());
    }

    /**
     * 保存菜单
     */
    public function save(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'MenuSave');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new AuthRule)->allowField(true)->isUpdate(false)->save($data)) {
                    return $this->success('保存成功');
                } else {
                    return $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑菜单
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $admin_menu = AuthRule::where(['id' => $id])->find();
        if (empty($admin_menu)) {
            return $this->error('获取数据失败');
        }
        return view('menu/edit')
            ->assign('admin_menu', $admin_menu)
            ->assign('admin_menu_level_list', AuthRule::getLevelList());
    }

    /**
     * 更新菜单
     * @param $id
     */
    public function update(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'MenuUpdate');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new AuthRule)->allowField(true)->isUpdate(true)->save($data, ['id' => $data['id']]) !== false) {
                    return $this->success('更新成功');
                } else {
                    return $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除菜单
     * @param $id
     */
    public function delete($id)
    {
        if (AuthRule::where(['pid' => $id])->count() > 0) {
            return $this->error('此菜单下存在子菜单，不可删除');
        }
        if (AuthRule::destroy($id)) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}
