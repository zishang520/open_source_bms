@extends('layouts/admin')
@section('body')
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">友情链接</li>
            <li class=""><a href="{{ url('admin/link/add') }}">添加链接</a></li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <table class="layui-table">
                    <colgroup>
                        <col width="15">
                        <col width="100">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>排序</th>
                        <th>名称</th>
                        <th>链接</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($link_list as $vo)
                    <tr>
                        <td>{{ $vo['id'] }}</td>
                        <td>{{ $vo['sort'] }}</td>
                        <td>{{ $vo['name'] }}</td>
                        <td>{{ $vo['link'] }}</td>
                        <td>{{ $vo['status'] ? '显示' : '隐藏' }}</td>
                        <td>
                            <a href="{{ url('admin/link/edit',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                            <a href="{{ url('admin/link/delete',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $link_list->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection