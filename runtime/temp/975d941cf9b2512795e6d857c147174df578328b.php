<?php $__env->startSection('body'); ?>
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">轮播图管理</li>
            <li class=""><a href="<?php echo e(url('admin/slide/add')); ?>">添加轮播图</a></li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <table class="layui-table">
                    <thead>
                    <tr>
                        <th style="width: 30px;">ID</th>
                        <th style="width: 30px;">排序</th>
                        <th>名称</th>
                        <th>分类</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $slide_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($vo['id']); ?></td>
                        <td><?php echo e($vo['sort']); ?></td>
                        <td><?php echo e($vo['name']); ?></td>
                        <td><?php echo e(isset($slide_category_list[$vo['cid']])?$slide_category_list[$vo['cid']]:'未分类'); ?></td>
                        <td><?php echo e($vo['status'] ? '显示' : '隐藏'); ?></td>
                        <td>
                            <a href="<?php echo e(url('admin/slide/edit',['id'=>$vo['id']])); ?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                            <a href="<?php echo e(url('admin/slide/delete',['id'=>$vo['id']])); ?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>