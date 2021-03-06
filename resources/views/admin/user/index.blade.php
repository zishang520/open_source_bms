@extends('layouts/admin')
@section('body')
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">用户管理</li>
            <li class=""><a href="{{ url('admin/user/add') }}">添加用户</a></li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">

                <form class="layui-form layui-form-pane" action="{{ url('admin/user/index') }}" method="get">
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

                <table class="layui-table">
                    <colgroup>
                        <col width="15">
                        <col width="100">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>手机</th>
                        <th>邮箱</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th>最后登录时间</th>
                        <th>最后登录IP</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user_list as $vo)
                    <tr>
                        <td>{{ $vo['id'] }}</td>
                        <td>{{ $vo['username'] }}</td>
                        <td>{{ $vo['mobile'] }}</td>
                        <td>{{ $vo['email'] }}</td>
                        <td>{{ $vo['status']==1 ? '启用' : '禁用' }}</td>
                        <td>{{ $vo['create_time'] }}</td>
                        <td>{{ $vo['last_login_time'] }}</td>
                        <td>{{ $vo['last_login_ip'] }}</td>
                        <td>
                            <a href="{{ url('admin/user/edit',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                            <a href="{{ url('admin/user/delete',['id'=>$vo['id']]) }}" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <!--分页-->
                {!! $user_list->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection