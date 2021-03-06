<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Open Source BMS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/static/js/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/admin.css">
    <!--[if lt IE 9]>
    <script src="/static/js/html5shiv.min.js"></script>
    <script src="/static/js/respond.min.js"></script>
    <style>
        .login .login-form input {color: #000;}
    </style>
    <![endif]-->
</head>
<body class="login">
<div class="login-title">Open Source BMS</div>
<form class="layui-form login-form" action="{{ url('admin/login/login') }}" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-block">
            <input type="text" name="username" required lay-verify="required" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-block">
            <input type="password" name="password" required lay-verify="required" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">验证码</label>
        <div class="layui-input-block">
            <input type="text" name="verify" required lay-verify="required" class="layui-input layui-input-inline">
            <img src="{{ captcha_src() }}" alt="点击更换" title="点击更换" onclick="this.src='{{ captcha_src() }}?time='+Math.random()" class="captcha">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="*">登 录</button>
        </div>
    </div>
</form>
<script>
    // 定义全局JS变量
    var GV = {
        current_controller: "admin/{{ isset($controller)?$controller:'' }}/"
    };
</script>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layui/lay/dest/layui.all.js"></script>
<script src="/static/js/admin.js"></script>
</body>
</html>