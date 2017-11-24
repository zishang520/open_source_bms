@extends('layouts/admin')
@section('body')
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">站点配置</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form form-container" action="{{ url('admin/System/update_site_config') }}" method="post">
                    <div class="layui-form-item">
                        <label class="layui-form-label">网站标题</label>
                        <div class="layui-input-block">
                            <input type="text" name="site_config[site_title]" value="{{ isset($site_config['site_title'])?$site_config['site_title']:'' }}" required  lay-verify="required" placeholder="请输入网站标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">SEO标题</label>
                        <div class="layui-input-block">
                            <input type="text" name="site_config[seo_title]" value="{{ isset($site_config['seo_title'])?$site_config['seo_title']:'' }}" placeholder="请输入SEO标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">SEO关键字</label>
                        <div class="layui-input-block">
                            <input type="text" name="site_config[seo_keyword]" value="{{ isset($site_config['seo_keyword'])?$site_config['seo_keyword']:'' }}" placeholder="请输入SEO关键字" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">SEO说明</label>
                        <div class="layui-input-block">
                            <textarea name="site_config[seo_description]" placeholder="请输入SEO说明" class="layui-textarea">{{ isset($site_config['seo_description'])?$site_config['seo_description']:'' }}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">版权信息</label>
                        <div class="layui-input-block">
                            <input type="text" name="site_config[site_copyright]" value="{{ isset($site_config['site_copyright'])?$site_config['site_copyright']:'' }}" placeholder="请输入版权信息" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">ICP备案号</label>
                        <div class="layui-input-block">
                            <input type="text" name="site_config[site_icp]" value="{{ isset($site_config['site_icp'])?$site_config['site_icp']:'' }}" placeholder="请输入版权信息" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">统计代码</label>
                        <div class="layui-input-block">
                            <textarea name="site_config[site_tongji]" placeholder="请输入统计代码" class="layui-textarea">{{ isset($site_config['site_tongji'])?$site_config['site_tongji']:'' }}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="*">提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection