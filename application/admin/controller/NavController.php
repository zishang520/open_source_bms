<?php
namespace app\admin\controller;

use app\common\model\Nav as NavModel;
use app\common\controller\AdminBaseController;
use think\Db;

/**
 * 导航管理
 * Class Nav
 * @package app\admin\controller
 */
class NavController extends AdminBaseController
{

    protected $navModel;

    protected function _initialize()
    {
        parent::_initialize();
        $this->navModel = new NavModel();
        $nav_list        = $this->navModel->order(['sort' => 'ASC', 'id' => 'ASC'])->select();
        $nav_level_list  = array2level($nav_list);

        $this->assign('nav_level_list', $nav_level_list);
    }

    /**
     * 导航管理
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 添加导航
     * @param string $pid
     * @return mixed
     */
    public function add($pid = '')
    {
        return $this->fetch('add', ['pid' => $pid]);
    }

    /**
     * 保存导航
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'Nav');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ($this->navModel->save($data)) {
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
        $nav = $this->navModel->find($id);

        return $this->fetch('edit', ['nav' => $nav]);
    }

    /**
     * 更新导航
     * @param $id
     */
    public function update($id)
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'Nav');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ($this->navModel->save($data, $id) !== false) {
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
        if ($this->navModel->destroy($id)) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}