@extends('layouts/admin')
@section('body')
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">文章管理</li>
            <li class=""><a href="{{ url('admin/article/add') }}">添加文章</a></li>
        </ul>
        <div class="layui-tab-content">

            <form class="layui-form layui-form-pane" action="{{ url('admin/article/index') }}" method="get">
                <div class="layui-inline">
                    <label class="layui-form-label">分类</label>
                    <div class="layui-input-inline">
                        <select name="cid">
                            <option value="0">全部</option>
                            @foreach($category_level_list as $vo)
                            <option value="{{ $vo['id'] }}" @if($search['cid']==$vo['id']) selected="selected"@endif>{{ $vo['level'] != 1 ? '|' . str_repeat(' ----', $vo['level'] - 1) : '' }} {{ $vo['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-inline">
                        <input type="text" name="keyword" value="{{ $search['keyword'] }}" placeholder="请输入关键词" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn">搜索</button>
                </div>
            </form>
            <hr>

            <form action="" method="post" class="ajax-form">
                <button type="button" class="layui-btn layui-btn-small ajax-action" data-action="{{ url('admin/article/toggle',['type'=>'audit']) }}">审核</button>
                <button type="button" class="layui-btn layui-btn-warm layui-btn-small ajax-action" data-action="{{ url('admin/article/toggle',['type'=>'cancel_audit']) }}">取消审核</button>
                <button type="button" class="layui-btn layui-btn-danger layui-btn-small ajax-action" data-action="{{ url('admin/article/delete') }}">删除</button>
                <div class="layui-tab-item layui-show">
                    <table class="layui-table">
                        <colgroup>
                            <col width="15">
                            <col width="50">
                            <col>
                        </colgroup>
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="check-all" name="" lay-skin="primary" lay-filter="allChoose">
                            </th>
                            <th>ID</th>
                            <th>排序</th>
                            <th>标题</th>
                            <th>栏目</th>
                            <th>作者</th>
                            <th>阅读量</th>
                            <th>状态</th>
                            <th>发布时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($article_list as $vo)
                        <tr>
                            <td>
                                <input type="checkbox" name="ids[]" value="{{ $vo['id'] }}" lay-skin="primary">
                            </td>
                            <td>{{ $vo['id'] }}</td>
                            <td>{{ $vo['sort'] }}</td>
                            <td>{{ $vo['title'] }}</td>
                            <td>{{ $vo['category']['name'] }}</td>
                            <td>{{ $vo['author'] }}</td>
                            <td>{{ $vo['reading'] }}</td>
                            <td>{{ $vo['status']==1 ? '已审核' : '未审核' }}</td>
                            <td>{{ $vo['publish_time'] }}</td>
                            <td>
                                <a href="{{ url('admin/article/edit',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                                <a href="{{ url('admin/article/delete',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--分页-->
                    {{ $article_list->render() }}
                </div>
            </form>
        </div>
    </div>
</div>
@endsection