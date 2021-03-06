@extends('layouts/admin')
@section('body')
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">权限组</li>
            <li class=""><a href="{{ url('admin/auth_group/add') }}">添加权限组</a></li>
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
                            <td>标识</td>
                            <th>名称</th>
                            <th>状态</th>
                            <th>描述</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($auth_group_list as $vo)
                        <tr>
                            <td>{{ $vo['id'] }}</td>
                            <td>{{ $vo['name'] }}</td>
                            <td>{{ $vo['title'] }}</td>
                            <td>{{ $vo['status']==1 ? '启用' : '禁用' }}</td>
                            <td>{{ $vo['description'] }}</td>
                            <td>
                                <a href="{{ url('admin/auth_group/auth',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-mini">授权</a>
                                <a href="{{ url('admin/auth_group/edit',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                                <a href="{{ url('admin/auth_group/delete',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $auth_group_list->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection