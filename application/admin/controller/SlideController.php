<?php
namespace app\admin\controller;

use app\common\model\SlideCategory as SlideCategoryModel;
use app\common\model\Slide as SlideModel;
use app\common\controller\AdminBaseController;
use think\Db;

/**
 * 轮播图管理
 * Class Slide
 * @package app\admin\controller
 */
class SlideController extends AdminBaseController
{
    /**
     * 轮播图管理
     * @return mixed
     */
    public function index()
    {
        $slide_category_model = new SlideCategoryModel();
        $slide_category_list  = $slide_category_model->column('name', 'id');
        $slide_list           = SlideModel::all();

        return $this->fetch('index', ['slide_list' => $slide_list, 'slide_category_list' => $slide_category_list]);
    }

    /**
     * 添加轮播图
     * @return mixed
     */
    public function add()
    {
        $slide_category_list = SlideCategoryModel::all();

        return $this->fetch('add', ['slide_category_list' => $slide_category_list]);
    }

    /**
     * 保存轮播图
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'Slide');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                $slide_model = new SlideModel();
                if ($slide_model->allowField(true)->save($data)) {
                    return $this->success('保存成功');
                } else {
                    return $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑轮播图
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $slide_category_list = SlideCategoryModel::all();
        $slide               = SlideModel::get($id);

        return $this->fetch('edit', ['slide' => $slide, 'slide_category_list' => $slide_category_list]);
    }

    /**
     * 更新轮播图
     * @param $id
     */
    public function update($id)
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'Slide');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                $slide_model = new SlideModel();
                if ($slide_model->allowField(true)->save($data, $id) !== false) {
                    return $this->success('更新成功');
                } else {
                    return $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除轮播图
     * @param $id
     */
    public function delete($id)
    {
        if (SlideModel::destroy($id)) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}