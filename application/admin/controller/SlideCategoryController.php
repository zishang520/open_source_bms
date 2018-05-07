<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\SlideCategory;
use think\Request;

/**
 * 轮播图分类
 * Class SlideCategory
 * @package app\admin\controller
 */
class SlideCategoryController extends AdminBaseController
{
    /**
     * 轮播图分类
     * @return mixed
     */
    public function index()
    {
        return view('slide_category/index')
            ->assign('slide_category_list', SlideCategory::paginate(15, false));
    }

    /**
     * 添加分类
     * @return mixed
     */
    public function add()
    {
        return view('slide_category/add');
    }

    /**
     * 保存分类
     */
    public function save(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'SlideCategory');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new SlideCategory)->allowField(true)->isUpdate(false)->save($data)) {
                    return $this->success('保存成功');
                } else {
                    return $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑分类
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $slide_category = SlideCategory::where(['id' => $id])->find();
        if (empty($slide_category)) {
            return $this->error('分类信息获取失败了');
        }
        return view('slide_category/edit')
            ->assign('slide_category', $slide_category);
    }

    /**
     * 更新分类
     * @throws \think\Exception
     */
    public function update(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'SlideCategoryUpdate');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new SlideCategory)->allowField(true)->isUpdate(true)->save($data, ['id' => $data['id']]) !== false) {
                    return $this->success('更新成功');
                } else {
                    return $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除分类
     * @param $id
     * @throws \think\Exception
     */
    public function delete($id)
    {
        if (SlideCategory::destroy($id) !== false) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}
