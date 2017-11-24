@extends('layouts/admin')

@section('body')
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">网站概览</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <table class="layui-table">
                    <tr>
                        <td style="width: 400px;">网站域名</td>
                        <td>{{ $config['url'] }}</td>
                    </tr>
                    <tr>
                        <td>网站目录</td>
                        <td>{{ $config['document_root'] }}</td>
                    </tr>
                    <tr>
                        <td>服务器操作系统</td>
                        <td>{{ $config['server_os'] }}</td>
                    </tr>
                    <tr>
                        <td>服务器端口</td>
                        <td>{{ $config['server_port'] }}</td>
                    </tr>
                    <tr>
                        <td>服务器环境</td>
                        <td>{{ $config['server_soft'] }}</td>
                    </tr>
                    <tr>
                        <td>PHP版本</td>
                        <td>{{ $config['php_version'] }}</td>
                    </tr>
                    <tr>
                        <td>MySQL版本</td>
                        <td>{{ $config['mysql_version'] }}</td>
                    </tr>
                    <tr>
                        <td>最大上传限制</td>
                        <td>{{ $config['max_upload_size'] }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection