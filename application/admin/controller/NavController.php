<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\Nav;
use think\Request;

/**
 * 导航管理
 * Class Nav
 * @package app\admin\controller
 */
class NavController extends AdminBaseController
{

    /**
     * 导航管理
     * @return mixed
     */
    public function index()
    {
        return view('nav/index')
            ->assign('nav_level_list', Nav::getLevelList());
    }

    /**
     * 添加导航
     * @param string $pid
     * @return mixed
     */
    public function add($pid = '')
    {
        return view('nav/add')
            ->assign('pid', $pid)
            ->assign('nav_level_list', Nav::getLevelList());
    }

    /**
     * 保存导航
     */
    public function save(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'NavSave');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new Nav)->allowField(true)->isUpdate(false)->save($data)) {
                    return $this->success('保存成功');
                } else {
                    return $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑导航
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $nav = Nav::where(['id' => $id])->find();
        if (empty($nav)) {
            return $this->error('导航数据获取失败');
        }
        return view('nav/edit')
            ->assign('nav', $nav)
            ->assign('nav_level_list', Nav::getLevelList());
    }

    /**
     * 更新导航
     * @param $id
     */
    public function update(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'NavUpdate');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new Nav)->allowField(true)->isUpdate(true)->save($data, ['id' => $id]) !== false) {
                    return $this->success('更新成功');
                } else {
                    return $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除导航
     * @param $id
     */
    public function delete($id)
    {
        if (Nav::destroy($id)) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}
