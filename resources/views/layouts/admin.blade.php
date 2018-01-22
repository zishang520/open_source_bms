<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>后台管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="/static/js/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/js/layui/css/layui.ext.css" media="all">
    <link rel="stylesheet" href="/static/css/font-awesome.min.css">
    <!--CSS引用-->
    @yield('css')
    <link rel="stylesheet" href="/static/css/admin.css">
    <!--[if lt IE 9]>
    <script src="/static/css/html5shiv.min.js"></script>
    <script src="/static/css/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="layui-layout layui-layout-admin">
    <!--头部-->
    <div class="layui-header header">
        <a href="{{ url('/admin') }}" class="admin-logo"><img class="logo" src="/static/images/admin_logo.png" alt=""></a>
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="javascript:void(0);" class="admin-side-toggle" title="收起" target="_blank"><i class="fa fa-bars" aria-hidden="true"></i></a></li>
            <li class="layui-nav-item"><a href="javascript:void(0);" id="trigger-fullscreen" title="全屏" target="_blank"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item"><a href="{{ url('/') }}" target="_blank">前台首页</a></li>
            <li class="layui-nav-item"><a href="" data-url="{{ url('admin/system/clear') }}" id="clear-cache">清除缓存</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">{{ session('admin_name') }}</a>
                <dl class="layui-nav-child"> <!-- 二级菜单 -->
                    <dd><a href="{{ url('admin/change_password/index') }}">修改密码</a></dd>
                    <dd><a href="{{ url('admin/login/logout') }}">退出登录</a></dd>
                </dl>
            </li>
        </ul>
    </div>

    <!--侧边栏-->
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree">
                <li class="layui-nav-item layui-nav-title"><a>管理菜单</a></li>
                <li class="layui-nav-item">
                    <a href="{{ url('admin/index/index') }}"><i class="fa fa-home"></i> 网站信息</a>
                </li>
                @foreach($menu as $vo)
                @if(isset($vo['children']))
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="{{ $vo['icon'] }}"></i> {{ $vo['title'] }}</a>
                    <dl class="layui-nav-child">
                        @foreach($vo['children'] as $v)
                        <dd><a href="{{ url($v['name']) }}"> {{ $v['title'] }}</a></dd>
                        @endforeach
                    </dl>
                </li>
                @else
                <li class="layui-nav-item">
                    <a href="{{ url($vo['name']) }}"><i class="{{ $vo['icon'] }}"></i> {{ $vo['title'] }}</a>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>

    <!--主体-->
    @yield('body')
    <!--底部-->
    <div class="layui-footer footer">
        <div class="layui-main">
            <p>2016-2017 &copy; <a href="https://github.com/xiayulei/open_source_bms" target="_blank">Open Source BMS</a></p>
        </div>
    </div>
</div>

<script>
    // 定义全局JS变量
    var GV = {
        current_controller: "admin/{{ isset($controller)?$controller:'' }}/",
        base_url: "/static"
    };
</script>
<!--JS引用-->
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui/lay/dest/layui.all.js"></script>
<script src="/static/js/admin.js"></script>
@yield('js')
<!--页面JS脚本-->
@yield('script')
</body>
</html>