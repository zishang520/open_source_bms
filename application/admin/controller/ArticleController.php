<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\common\model\Article;
use app\common\model\ArticleCategory;
use think\Request;

/**
 * 文章管理
 * Class Article
 * @package app\admin\controller
 */
class ArticleController extends AdminBaseController
{
    /**
     * 文章管理
     * @return mixed
     */
    public function index(Request $request)
    {
        $map = [];
        $search = ['keyword' => '', 'cid' => 0];
        $params = array_filter($request->get() + $search, function ($k) use ($search) {
            return in_array($k, array_keys($search));
        }, ARRAY_FILTER_USE_KEY);

        if (isset($params['keyword']) && $params['keyword'] != '') {
            $map['title'] = ['like', "%{$params['keyword']}%"];
        }
        if (!empty($params['cid'])) {
            $category_children_ids = ArticleCategory::where(['path' => ['like', "%,{$params['cid']},%"]])->column('id');
            $category_children_ids = (!empty($category_children_ids) && is_array($category_children_ids)) ? implode(',', $category_children_ids) . ',' . $params['cid'] : $params['cid'];
            $map['cid'] = ['IN', $category_children_ids];
        }
        $article_list = Article::field('id,title,cid,author,reading,status,publish_time,sort')
            ->with(['category'])
            ->where($map)
            ->order(['publish_time' => 'DESC'])
            ->paginate(15, false, ['query' => $params]);

        return view('article/index')
            ->assign('article_list', $article_list)
            ->assign('category_list', ArticleCategory::column('name', 'id'))
            ->assign('category_level_list', ArticleCategory::getLevelList())
            ->assign('search', $params);
    }

    /**
     * 添加文章
     * @return mixed
     */
    public function add()
    {
        return view('article/add')
            ->assign('category_level_list', ArticleCategory::getLevelList());
    }

    /**
     * 保存文章
     */
    public function save(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'Article');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new Article)->allowField(true)->isUpdate(false)->save($data) !== false) {
                    return $this->success('保存成功');
                } else {
                    return $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑文章
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $article = Article::find($id);
        if (empty($article)) {
            return $this->error('文章数据不存在');
        }
        return view('article/edit')
            ->assign('category_level_list', ArticleCategory::getLevelList())
            ->assign('article', $article);
    }

    /**
     * 更新文章
     * @param $id
     */
    public function update(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate_result = $this->validate($data, 'ArticleUpdate');

            if ($validate_result !== true) {
                return $this->error($validate_result);
            } else {
                if ((new Article)->allowField(true)->isUpdate(true)->save($data, ['id' => $data['id']]) !== false) {
                    return $this->success('更新成功');
                } else {
                    return $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除文章
     * @param int   $id
     * @param array $ids
     */
    public function delete(Request $request, $id = 0)
    {
        if ($request->has('ids', 'param', true)) {
            $id = $request->post('ids/a');
        }
        if (!empty($id)) {
            if (Article::destroy($id)) {
                return $this->success('删除成功');
            } else {
                return $this->error('删除失败');
            }
        } else {
            return $this->error('请选择需要删除的文章');
        }
    }

    /**
     * 文章审核状态切换
     * @param array  $ids
     * @param string $type 操作类型
     */
    public function toggle(Request $request, $type = '')
    {
        $data = [];
        $status = $type == 'audit' ? 1 : 0;
        $ids = $request->post('ids/a');
        if (!empty($ids)) {
            foreach ($ids as $value) {
                $data[] = ['id' => $value, 'status' => $status];
            }
            if ((new Article)->saveAll($data) !== false) {
                return $this->success('操作成功');
            } else {
                return $this->error('操作失败');
            }
        } else {
            return $this->error('请选择需要操作的文章');
        }
    }
}
