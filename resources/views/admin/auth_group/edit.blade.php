@extends('layouts/admin')
@section('body')
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class=""><a href="{{ url('admin/auth_group/index') }}">权限组</a></li>
            <li class=""><a href="{{ url('admin/auth_group/add') }}">添加权限组</a></li>
            <li class="layui-this">编辑权限组</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form form-container" action="{{ url('admin/auth_group/update') }}" method="post">
                    <div class="layui-form-item">
                        <label class="layui-form-label">权限标识</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" value="{{ $auth_group['name'] }}" required  lay-verify="required" placeholder="用于验证的权限标识" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" value="{{ $auth_group['title'] }}" required lay-verify="required" placeholder="请输入权限组名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">描述信息</label>
                        <div class="layui-input-block">
                            <textarea name="description" placeholder="权限描述信息" class="layui-textarea">{{ $auth_group['description'] }}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                            <input type="radio" name="status" value="1" title="启用" @if($auth_group['status']==1) checked="checked"@endif>
                            <input type="radio" name="status" value="0" title="禁用" @if($auth_group['status']==0) checked="checked"@endif>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <input type="hidden" name="id" value="{{ $auth_group['id'] }}">
                            <button class="layui-btn" lay-submit lay-filter="*">更新</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection