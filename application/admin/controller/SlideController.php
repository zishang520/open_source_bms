<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\Slide;
use app\common\model\SlideCategory;
use think\Request;

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
        return view('slide/index')
            ->assign('slide_list', Slide::paginate(15, false))
            ->assign('slide_category_list', SlideCategory::field('`name`, `id`')->select());
    }

    /**
     * 添加轮播图
     * @return mixed
     */
    public function add()
    {
        return view('slide/add')
            ->assign('slide_category_list', SlideCategory::field('`name`, `id`')->select());
    }

    /**
     * 保存轮播图
     */
    public function save(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'Slide');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new Slide)->allowField(true)->isUpdate(false)->save($data)) {
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
        $slide = Slide::where(['id' => $id])->find();
        if (empty($slide)) {
            return $this->error('数据获取失败');
        }
        return view('slide/edit')
            ->assign('slide', $slide)
            ->assign('slide_category_list', SlideCategory::field('`name`, `id`')->select());
    }

    /**
     * 更新轮播图
     * @param $id
     */
    public function update(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'SlideUpdate');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new Slide)->allowField(true)->isUpdate(true)->save($data, ['id' => $data['id']]) !== false) {
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
        if (Slide::destroy($id)) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}
