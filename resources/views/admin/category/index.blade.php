@extends('layouts/admin')
@section('body')
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">栏目管理</li>
            <li class=""><a href="{{ url('admin/category/add') }}">添加栏目</a></li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <table class="layui-table">
                    <thead>
                    <tr>
                        <th style="width: 30px;">ID</th>
                        <th style="width: 30px;">排序</th>
                        <th>栏目名称</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category_level_list as $vo)
                    <tr>
                        <td>{{ $vo['id'] }}</td>
                        <td>{{ $vo['sort'] }}</td>
                        <td>{{ $vo['level'] != 1 ? '|' . str_repeat(' ----', $vo['level'] - 1) : '' }} {{ $vo['name'] }}</td>
                        <td>
                            <a href="{{ url('admin/category/add',['pid'=>$vo['id']]) }}" class="layui-btn layui-btn-mini">添加子栏目</a>
                            <a href="{{ url('admin/category/edit',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                            <a href="{{ url('admin/category/delete',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection