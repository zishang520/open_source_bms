@extends('base')
@section('body')
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">后台菜单</li>
            <li class=""><a href="{{ url('admin/menu/add') }}">添加菜单</a></li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <table class="layui-table">
                    <thead>
                    <tr>
                        <th style="width: 30px;">ID</th>
                        <th style="width: 30px;">排序</th>
                        <th>菜单名称</th>
                        <th>控制器方法</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admin_menu_level_list as $vo)
                    <tr>
                        <td>{{ $vo['id'] }}</td>
                        <td>{{ $vo['sort'] }}</td>
                        <td>{neq name="vo.level" value="1"}|{php}for($i=1;$i<$vo['level'];$i++){echo ' ----';}{/php}{/neq} {{ $vo['title'] }}</td>
                        <td>{{ $vo['name'] }}</td>
                        <td>{{ $vo['status']==1 ? '显示' : '隐藏' }}</td>
                        <td>
                            <a href="{{ url('admin/menu/add',['pid'=>$vo['id']]) }}" class="layui-btn layui-btn-mini">添加子菜单</a>
                            <a href="{{ url('admin/menu/edit',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                            <a href="{{ url('admin/menu/delete',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
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