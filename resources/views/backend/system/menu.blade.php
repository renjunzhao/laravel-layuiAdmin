<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 内容系统 - 菜单列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{url('src/layuiadmin/style/admin.css')}}" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">菜单名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>


                <div class="layui-inline">
                    <button class="layui-btn layuiadmin-btn-list" lay-submit lay-filter="LAY-app-contlist-search">
                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                    </button>
                </div>
            </div>
        </div>
        {{csrf_field()}}
        <input type="hidden" name="token" value="{{$token}}" id="token">
        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
{{--                <button class="layui-btn layuiadmin-btn-list" data-type="batchdel">删除</button>--}}
                <button class="layui-btn layuiadmin-btn-list" data-type="add">添加</button>
            </div>
            <table id="LAY-app-content-list" lay-filter="LAY-app-content-list"></table>
            <script type="text/html" id="buttonTpl">
                <button class="layui-btn layui-btn-xs">已发布</button>
                <button class="layui-btn layui-btn-primary layui-btn-xs">待修改</button>
            </script>
            <script type="text/html" id="table-content-list">
                <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="last"><i
                        class="layui-icon">&#xe654;</i>下级菜单</a>
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                        class="layui-icon layui-icon-edit"></i>编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                        class="layui-icon layui-icon-delete"></i>删除</a>
            </script>
        </div>
    </div>
</div>

<script src="{{url('src/layuiadmin/layui/layui.js')}}"></script>
<script>
    layui.config({
        base: '../../../layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'contlist', 'table'], function () {
        var table = layui.table
            , form = layui.form;

        //监听搜索
        form.on('submit(LAY-app-contlist-search)', function (data) {
            var field = data.field;
            var token = $('#token').val();
            var title = '';
            var tit = '';

            if (field.title) {
                var title = '&search=title:' + field.title;
                var tit = 'title:' + field.title;
            }
            var field = {
                searchJoin: 'and',
                search: tit ,
            }
            $.ajax({
                url: 'menu?type=1&token=' + token + '&searchJoin=and' + title,
                type: 'get',
                success: function (data) {
                    if (data.data.code == 1001) {
                        //执行重载
                        table.reload('LAY-app-content-list', {
                            where: field
                        });
                    } else {
                        //执行重载
                        table.reload('LAY-app-content-list', {
                            where: field
                        });
                    }
                }
            });
            //执行重载

        });

        var $ = layui.$, active = {
            batchdel: function () {
                var checkStatus = table.checkStatus('LAY-app-content-list')
                    , checkData = checkStatus.data; //得到选中的数据

                if (checkData.length === 0) {
                    return layer.msg('请选择数据');
                }
                var token = $('#token').val();
                layer.confirm('确定删除吗？', function (index) {
                    $.ajax({
                        url: 'batch?token=' + token,
                        type: 'post',
                        data: {"arr": checkData},
                        success: function (data) {
                            table.reload('LAY-app-content-list');
                            layer.msg('已删除');
                        }
                    });

                });
            },
            add: function () {
                var token = $('#token').val()
                layer.open({
                    type: 2
                    , title: '添加菜单'
                    , content: 'menu/create?token=' + token
                    , maxmin: true
                    , area: ['550px', '550px']
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        //点击确认触发 iframe 内容中的按钮提交
                        var submit = layero.find('iframe').contents().find("#layuiadmin-app-form-submit");
                        submit.click();
                    }
                });
            }
        };
        layui.define(['table', 'form'], function (exports) {
            var $ = layui.$
                , table = layui.table
                , form = layui.form;
            var token = $('#token').val()
            //菜单管理
            table.render({
                elem: '#LAY-app-content-list'
                , url: 'menu?type=1&token=' + token //模拟接口
                , cols: [[
                    {type: 'checkbox', fixed: 'left'}
                    , {field: 'id', width: 100, title: 'ID', sort: true}
                    , {field: 'title', title: '菜单名'}
                    , {field: '_title', title: '上级菜单', minWidth: 100}
                    , {field: 'sort', title: '排序', minWidth: 100}
                    , {field: 'group', title: '分组', minWidth: 100}
                    , {field: 'url', title: '路由', minWidth: 100}
                    , {field: 'icon', title: '图标', minWidth: 100}
                    , {
                        field: 'is_developer',
                        title: '是否开发模式可见',
                        minWidth: 80,
                        align: 'center',
                        templet: function (res) {
                            if (res.is_developer == 1) {
                                return "<button class=\"layui-btn layui-btn-xs\">是</button>";
                            } else {
                                return " <button class=\"layui-btn layui-btn-primary layui-btn-xs\">否</button>";
                            }
                        }
                    }
                    , {
                        field: 'is_show', title: '是否展示', minWidth: 80, align: 'center', templet: function (res) {
                            if (res.is_show == 1) {
                                return "<button class=\"layui-btn layui-btn-xs\">是</button>";
                            } else {
                                return " <button class=\"layui-btn layui-btn-primary layui-btn-xs\">否</button>";
                            }
                        }
                    }
                    , {field: 'created_at',minWidth: 200, title: '创建时间', sort: true}
                    , {title: '操作', minWidth: 300, align: 'center', fixed: 'right', toolbar: '#table-content-list'}
                ]]
                , page: true
                , limit: 10
                , limits: [10, 15, 20, 25, 30]
                , text: '对不起，加载出现异常！'
            });

            $.ajax({
                url: 'menu?type=1&token=',
                type: 'get',
                success: function (data) {
                    if (data.data.code == 1001) {
                        //执行重载
                        table.reload('LAY-app-content-list', {
                            where: field
                        });
                    } else {
                        //执行重载
                        table.reload('LAY-app-content-list', {
                            where: field
                        });
                    }
                }
            });

            //监听工具条
            table.on('tool(LAY-app-content-list)', function (obj) {
                var data = obj.data;
                if (obj.event === 'del') {
                    layer.confirm('确定删除此菜单？', function (index) {
                        $.ajax({
                            url: '/menu/' + obj.data.id + '?token=' + token,
                            type: 'delete',
                            success: function (data) {
                                table.reload('LAY-app-content-list');
                                layer.msg('已删除');
                                layer.close(index);
                            }
                        });
                    });
                } else if (obj.event === 'edit') {
                    layer.open({
                        type: 2
                        , title: '编辑菜单'
                        , content: '/menu/' + data.id + '?token=' + token
                        , maxmin: true
                        , area: ['550px', '550px']
                        , btn: ['确定', '取消']
                        , yes: function (index, layero) {
                            var iframeWindow = window['layui-layer-iframe' + index]
                                , submit = layero.find('iframe').contents().find("#layuiadmin-app-form-edit");

                            //监听提交
                            iframeWindow.layui.form.on('submit(layuiadmin-app-form-edit)', function (data) {
                                var field = data.field; //获取提交的字段
                                console.log(field)
                                //提交 Ajax 成功后，静态更新表格中的数据
                                $.ajax({
                                    url: '/menu/' + field.id + '?token=' + token, //实际使用请改成服务端真实接口
                                    type: 'put',
                                    data: field,
                                    success: function (res) {
                                        table.reload('LAY-app-content-list');
                                        layer.close(index); //关闭弹层
                                    }
                                });
                            });

                            submit.trigger('click');
                        }
                    });
                }else if(obj.event === 'last'){
                    $.ajax({
                        url: '/menu?type=1&pid=' + obj.data.id + '&token=' + token,
                        type: 'get',
                        success: function (data) {
                            var field = {
                                pid:obj.data.id
                            }
                            table.reload('LAY-app-content-list', {
                                where: field
                            });
                        }
                    });
                }
            });
        });


        $('.layui-btn.layuiadmin-btn-list').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

    });
</script>
</body>
</html>
