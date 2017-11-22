<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\Article;
use app\common\model\ArticleCategory;

/**
 * 栏目管理
 * Class Category
 * @package app\admin\controller
 */
class CategoryController extends AdminBaseController
{

    protected $categoryModel;
    protected $articleModel;

    protected function _initialize()
    {
        parent::_initialize();
        $this->articleModel = new Article();

        $this->assign('category_level_list', ArticleCategory::getLevelList());
    }

    /**
     * 栏目管理
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 添加栏目
     * @param string $pid
     * @return mixed
     */
    public function add($pid = '')
    {
        return $this->fetch('add', ['pid' => $pid]);
    }

    /**
     * 保存栏目
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();
            $validate_result = $this->validate($data, 'Category');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new ArticleCategory)->allowField(true)->save($data)) {
                    return $this->success('保存成功');
                } else {
                    return $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑栏目
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $category = ArticleCategory::where(['id' => $id])->find();

        return $this->fetch('edit', ['category' => $category]);
    }

    /**
     * 更新栏目
     * @param $id
     */
    public function update($id)
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();
            $validate_result = $this->validate($data, 'Category');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                $children = ArticleCategory::where(['path' => ['like', "%,{$id},%"]])->column('id');
                if (in_array($data['pid'], $children)) {
                    return $this->error('不能移动到自己的子分类');
                } else {
                    if ((new ArticleCategory)->allowField(true)->save($data, $id) !== false) {
                        return $this->success('更新成功');
                    } else {
                        return $this->error('更新失败');
                    }
                }
            }
        }
    }

    /**
     * 删除栏目
     * @param $id
     */
    public function delete($id)
    {
        if (ArticleCategory::where(['pid' => $id])->count() > 0) {
            return $this->error('此分类下存在子分类，不可删除');
        }
        if (Article::where(['cid' => $id])->count() > 0) {
            return $this->error('此分类下存在文章，不可删除');
        }
        if (ArticleCategory::destroy($id)) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}
