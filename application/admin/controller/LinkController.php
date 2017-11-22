<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\Link;
use think\Request;

/**
 * 友情链接
 * Class Link
 * @package app\admin\controller
 */
class LinkController extends AdminBaseController
{
    /**
     * 友情链接
     * @return mixed
     */
    public function index()
    {
        return view('link/index')
            ->assign('link_list', Link::paginate(15, false));
    }

    /**
     * 添加友情链接
     * @return mixed
     */
    public function add()
    {
        return view('link/add');
    }

    /**
     * 保存友情链接
     */
    public function save(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'LinkSave');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new Link)->allowField(true)->isUpdate(false)->save($data)) {
                    return $this->success('保存成功');
                } else {
                    return $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑友情链接
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $link = Link::where(['id' => $id])->find();
        if (empty($link)) {
            return $this->error('信息获取失败');
        }
        return view('link/edit')
            ->assign('link', $link);
    }

    /**
     * 更新友情链接
     * @param $id
     */
    public function update(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'LinkUpdate');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new Link)->allowField(true)->isUpdate(true)->save($data, ['id' => $data['id']]) !== false) {
                    return $this->success('更新成功');
                } else {
                    return $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除友情链接
     * @param $id
     */
    public function delete($id)
    {
        if (Link::destroy($id)) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}
