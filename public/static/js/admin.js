/**
 * 后台JS主入口
 */

var layer = layui.layer,
    element = layui.element(),
    laydate = layui.laydate,
    form = layui.form();

/**
 * AJAX全局设置
 */
$.ajaxSetup({
    error: function(xhr, textStatus, errorMsg) {
        layui.alert('系统错误' + this.url + "[" + xhr.status + "]:" + errorMsg);
    }
});

/**
 * 后台侧边菜单选中状态
 */
$('.layui-nav-item').find('a').removeClass('layui-this');
$('.layui-nav-tree').find('a[href*="' + GV.current_controller + '"]').parent().addClass('layui-this').parents('.layui-nav-item').addClass('layui-nav-itemed');

/**
 * 通用单图上传
 */
layui.upload({
    url: "/index.php/api/upload/upload",
    type: 'image',
    elem: '.layui-upload-image',
    ext: 'jpg|png|gif|bmp',
    success: function(data) {
        if (data.error === 0) {
            document.getElementById('thumb').value = data.url;
        } else {
            layer.msg(data.message);
        }
    }
});

/**
 * 通用日期时间选择
 */
lay('.datetime').each(function() {
    laydate.render({
        elem: this,
        type: 'datetime',
        trigger: 'click'
    });
});
/**
 * 通用日期时间选择
 */
lay('.date').each(function() {
    laydate.render({
        elem: this,
        type: 'date',
        trigger: 'click'
    });
});

/**
 * 通用日期时间选择
 */
lay('.time').each(function() {
    laydate.render({
        elem: this,
        type: 'time',
        trigger: 'click'
    });
});
/**
 * 通用表单提交(AJAX方式)
 */
form.on('submit(*)', function(data) {
    $.ajax({
        url: data.form.action,
        method: data.form.method,
        data: new FormData(data.form),
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(info) {
            layer.msg(info.msg, function() {
                if (info.code === 1) {
                    if (info.url.length > 0) {
                        location.href = info.url;
                    } else {
                        location.reload(true);
                    }
                }
            });
        }
    });
    return false;
});

/**
 * 通用批量处理（审核、取消审核、删除）
 */
$('.ajax-action').on('click', function() {
    var $this = $(this);
    var _action = $this.data('action');
    var form = $this.parents('form.ajax-form')[0];
    layer.open({
        shade: false,
        content: '确定执行此操作？',
        btn: ['确定', '取消'],
        yes: function(index) {
            $.ajax({
                url: _action,
                method: form.method,
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(info) {
                    layer.msg(info.msg, function() {
                        if (info.code === 1) {
                            if (info.url.length > 0) {
                                location.href = info.url;
                            } else {
                                location.reload(true);
                            }
                        }
                    });
                }
            });
            layer.close(index);
        }
    });

    return false;
});

/**
 * 通用全选
 */
layui.use('form', function() {
    var $ = layui.jquery,
        form = layui.form();
    //全选
    form.on('checkbox(allChoose)', function(data) {
        var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
        child.each(function(index, item) {
            item.checked = data.elem.checked;
        });
        form.render('checkbox');
    });
});
/**
 * 通用删除
 */
$('.ajax-delete').on('click', function() {
    var _href = $(this).attr('href');
    layer.open({
        shade: false,
        content: '确定删除？',
        btn: ['确定', '取消'],
        yes: function(index) {
            $.ajax({
                url: _href,
                type: "get",
                success: function(info) {
                    layer.msg(info.msg, function() {
                        if (info.code === 1) {
                            if (info.url.length > 0) {
                                location.href = info.url;
                            } else {
                                location.reload(true);
                            }
                        }
                    });
                }
            });
            layer.close(index);
        }
    });

    return false;
});

/**
 * 清除缓存
 */
$('#clear-cache').on('click', function() {
    var _url = $(this).data('url');
    if (_url !== 'undefined') {
        $.ajax({
            url: _url,
            success: function(data) {
                layer.msg(data.msg, function() {
                    if (data.code === 1) {
                        location.reload(true);
                    }
                });
            }
        });
    }

    return false;
});

/**
 * [selectCity 无限极下拉]
 * @Author    ZiShang520@gmail.com
 * @DateTime  2017-05-23T16:55:42+0800
 * @copyright (c)                      ZiShang520 All           Rights Reserved
 * @param     {[type]}                 Selectid   [description]
 * @return    {[type]}                            [description]
 */
var selectCity = function(param) {
    var form = layui.form();
    var option = Object.assign({
        element: undefined,
        maxcolumn: 3,
        provinceValue: undefined,
        cityValue: undefined,
        areaValue: undefined,
        streetValue: undefined,
        start: 1,
        className: '',
        level: {
            "1": "province",
            "2": "city",
            "3": "area",
            "4": "street"
        },
    }, param);
    var html = '<select class="' + option.className + '" lay-search placeholder="--请选择--"><option value="">--请选择--</option></select>';
    var parent = '<div class="layui-inline"></div>';
    // 异步执行
    var Runfunc = function(dom) {
        var ToFuc = function(level, parent_id) {
            var getNext = $(html);
            var $parent = $(parent);
            $.ajax({
                url: '/api/City/get/level/' + level + '/parent_id/' + parent_id,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if (!data.code) {
                        data = data.data;
                        if (data.length > 0) {
                            getNext.append('<option value="0" ' + ((option[option.level[data[0].level] + 'Value'] >> 0) === 0 ? 'selected="selected"' : '') + '>全部</option>');
                            getNext.append(data.map(function(item, key) {
                                return '<option value="' + item.value + '" data-level="' + item.level + '" ' + (option[option.level[data[0].level] + 'Value'] == item.value ? 'selected="selected"' : '') + '>' + item.text + '</option>';
                            }).join('')).attr('name', option.level[data[0].level]).attr('lay-filter', option.level[data[0].level]);
                            dom.append($parent.append(getNext));
                            form.render('select');
                            // 最大显示分级
                            if (parseInt(data[0].level, 10) + 1 > option.maxcolumn) {
                                return false;
                            }
                            $parent.nextAll().remove();
                            form.on('select(' + option.level[data[0].level] + ')', function(data) {
                                $parent.nextAll().remove();
                                ToFuc(parseInt($(data.elem).find('option').eq(data.elem.selectedIndex).data('level'), 10) + 1, data.value);
                            });
                            // 初始化加载
                            if (option[option.level[data[0].level] + 'Value'] !== undefined) {
                                ToFuc(parseInt(getNext.find('option').eq(getNext[0].selectedIndex).data('level'), 10) + 1, getNext[0].value);
                            }
                        }
                    }
                }
            });
        };
        if (option.start == 1) {
            var getRegionProvince = $(html);
            var $parent = $(parent);
            $.ajax({
                url: '/api/City/get',
                dataType: 'json',
                success: function(data) {
                    if (!data.code) {
                        data = data.data;
                        if (data.length > 0) {
                            getRegionProvince.append('<option value="0" ' + ((option[option.level[data[0].level] + 'Value'] >> 0) === 0 ? 'selected="selected"' : '') + '>全部</option>');
                            getRegionProvince.append(data.map(function(item, key) {
                                return '<option value="' + item.value + '" data-level="' + item.level + '" ' + (option.provinceValue == item.value ? 'selected="selected"' : '') + '>' + item.text + '</option>';
                            }).join('')).attr('name', option.level[data[0].level]).attr('lay-filter', option.level[data[0].level]);
                            dom.append($parent.append(getRegionProvince));
                            form.render('select');
                            $parent.nextAll().remove();
                            form.on('select(' + option.level[data[0].level] + ')', function(data) {
                                $parent.nextAll().remove();
                                ToFuc(parseInt($(data.elem).find('option').eq(data.elem.selectedIndex).data('level'), 10) + 1, data.value);
                            });
                            // 初始化加载
                            if (option.provinceValue !== undefined) {
                                ToFuc(parseInt(getRegionProvince.find('option').eq(getRegionProvince[0].selectedIndex).data('level'), 10) + 1, getRegionProvince[0].value);
                            }
                        }
                    }
                }
            });
        } else if ((/^[2-4]$/).test(option.start)) {
            ToFuc(option.start, option[option.level[(option.start >> 0) - 1] + 'Value']);
        }
    };
    var dom = $(option.element);
    if (dom.length === 0) {
        $(document).ready(function() {
            Runfunc($(option.element));
        });
    } else {
        Runfunc(dom);
    }
};
(function() {
    var status = 3;
    var sideWidth = $('.layui-side');
    var width = sideWidth.width();
    $('.admin-side-toggle').on('click', function() {
        if (status == 3 && width > 0) {
            $('.layui-body').animate({
                left: '0'
            }, function() {
                status -= 1;
            }); //admin-footer
            $('.layui-footer').animate({
                left: '0'
            }, function() {
                status -= 1;
            });
            sideWidth.animate({
                width: '0'
            }, function() {
                status -= 1;
            });
        } else {
            if (status !== 0) {
                status = 0;
            }
            $('.layui-body').animate({
                left: width + 'px'
            }, function() {
                status += 1;
            });
            $('.layui-footer').animate({
                left: width + 'px'
            }, function() {
                status += 1;
            });
            sideWidth.animate({
                width: width + 'px'
            }, function() {
                status += 1;
            });
        }
    });
})();

(function() {
    var toggle_fullscreen = function(a) {
        void 0 !== document.fullScreenElement && null === document.fullScreenElement || void 0 !== document.msFullscreenElement && null === document.msFullscreenElement || void 0 !== document.mozFullScreen && !document.mozFullScreen || void 0 !== document.webkitIsFullScreen && !document.webkitIsFullScreen ? a.requestFullScreen ? a.requestFullScreen() : a.mozRequestFullScreen ? a.mozRequestFullScreen() : a.webkitRequestFullScreen ? a.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT) : a.msRequestFullscreen && a.msRequestFullscreen() : document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen ? document.webkitCancelFullScreen() : document.msExitFullscreen && document.msExitFullscreen();
    };
    $("#trigger-fullscreen").click(function() {
        toggle_fullscreen(document.documentElement);
    });
})();

//Hash地址的定位
var layid = location.hash.replace(/^#HASH_FILER_TAB=/, '');
element.tabChange('HASH_FILER_TAB', layid);

element.on('tab(HASH_FILER_TAB)', function(elem) {
    location.hash = 'HASH_FILER_TAB=' + $(this).attr('lay-id');
});