@extends('layouts/admin')
@section('body')
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class=""><a href="{{ url('admin/nav/index') }}">导航管理</a></li>
            <li class=""><a href="{{ url('admin/nav/add') }}">添加导航</a></li>
            <li class="layui-this">编辑导航</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form form-container" action="{{ url('admin/nav/update') }}" method="post">
                    <div class="layui-form-item">
                        <label class="layui-form-label">上级导航</label>
                        <div class="layui-input-block">
                            <select name="pid" required lay-verify="required">
                                <option value="0">一级导航</option>
                                @foreach($nav_level_list as $vo)
                                <option value="{{ $vo['id'] }}" @if($nav['id']==$vo['id']) disabled="disabled"@endif @if($nav['pid']==$vo['id']) selected="selected"@endif>{{ $vo['level'] != 1 ? '|' . str_repeat(' ----', $vo['level'] - 1) : '' }} {{ $vo['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">导航名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" value="{{ $nav['name'] }}" required  lay-verify="required" placeholder="请输入导航名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">别名</label>
                        <div class="layui-input-block">
                            <input type="text" name="alias" value="{{ $nav['alias'] }}" placeholder="（选填）请输入导航别名" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">链接</label>
                        <div class="layui-input-block">
                            <input type="text" name="link" value="{{ $nav['link'] }}" placeholder="（选填）请输入导航链接" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">图标</label>
                        <div class="layui-input-block">
                            <input type="text" name="icon" value="{{ $nav['icon'] }}" placeholder="（选填）如：fa fa-home" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                            <input type="radio" name="status" value="1" title="显示" @if($nav['status']==1) checked="checked"@endif>
                            <input type="radio" name="status" value="0" title="隐藏" @if($nav['status']==0) checked="checked"@endif>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">打开方式</label>
                        <div class="layui-input-block">
                            <input type="radio" name="target" value="_self" title="默认" @if($nav['target']=='_self') checked="checked"@endif>
                            <input type="radio" name="target" value="_blank" title="新窗口" @if($nav['target']=='_blank') checked="checked"@endif>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-block">
                            <input type="text" name="sort" value="{{ $nav['sort'] }}" required  lay-verify="required" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <input type="hidden" name="id" value="{{ $nav['id'] }}">
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