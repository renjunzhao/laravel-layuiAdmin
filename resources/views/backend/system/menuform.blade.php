<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 菜单管理 iframe 框</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{url('assets/layui/css/layui.css')}}">
    <script src="{{url('assets/layui/layui.js')}}"></script>
    <script src="{{url('module/common.js')}}"></script>
</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list"
     style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">菜单名称</label>
        <div class="layui-input-inline">
            <input type="text" name="title" lay-verify="required" placeholder="请输入名称" autocomplete="off"
                   class="layui-input" value="{{isset($menu) ? $menu['title'] : ''}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">分组</label>
        <div class="layui-input-inline">
            <input type="text" name="group"  placeholder="请输入分组" autocomplete="off"
                   class="layui-input" value="{{isset($menu) ? $menu['group'] : ''}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">路由</label>
        <div class="layui-input-inline">
            <input type="text" name="url"  placeholder="请输入路由" autocomplete="off"
                   class="layui-input" value="{{isset($menu) ? $menu['url'] : ''}}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-inline">
            <input type="text" name="sort" placeholder="数字越大越靠前" autocomplete="off"
                   class="layui-input" value="{{isset($menu) ? $menu['sort'] : 0}}"
                   oninput="value=value.replace(/[^\d]/g,'')">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">上级菜单</label>
        <div class="layui-input-inline">
            <select name="pid" lay-verify="required">
                <option value="0">顶级菜单</option>
                @if(isset($menus))
                    @foreach($menus as $v)
                        <option value="{{$v['id']}}"
                                @if(isset($menu) && $menu['pid'] == $v['id']) selected @endif> {{$v['_title']}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="layui-form">
        <div class="layui-form-item">
            <label for="" class="layui-form-label">选择图标</label>
            <div class="layui-input-block">
                <input type="text" name="icon" id="iconPicker" lay-filter="iconPicker" class="layui-input" value="{{isset($menu) ? $menu['icon'] : ''}}">
            </div>
        </div>
    </div>
    <input type="hidden" name="token" id="token" value="{{$token}}">
    <input type="hidden" name="id" id="id" value="{{isset($menu) ? $menu['id'] : ''}}">
    <div class="layui-form-item" lay-filter="sex">
        <label class="layui-form-label">是否显示</label>
        <div class="layui-input-block">
            <input type="radio" name="is_show" value="1" title="是"
                   @if(isset($menu) && $menu['is_show'] == 1) checked @endif>
            <input type="radio" name="is_show" value="2" title="否"
                   @if(isset($menu) && $menu['is_show'] == 2) checked @endif>
        </div>
    </div>
    <div class="layui-form-item" lay-filter="sex">
        <label class="layui-form-label">是否开发模式可见</label>
        <div class="layui-input-block">
            <input type="radio" name="is_developer" value="1" title="是"
                   @if(isset($menu) && $menu['is_developer'] == 1) checked @endif>
            <input type="radio" name="is_developer" value="2" title="否"
                   @if(isset($menu) && $menu['is_developer'] == 2) checked @endif>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">菜单描述</label>
        <div class="layui-input-inline">
            <textarea name="describe"  style="width: 400px; height: 150px;" autocomplete="off"
                      class="layui-textarea">{{isset($menu) ? $menu['describe'] : ''}}</textarea>
        </div>
    </div>
    {{csrf_field()}}

    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-submit" id="layuiadmin-app-form-submit"
               value="确认添加">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit"
               value="确认编辑">
    </div>
</div>

<script src="{{url('src/layuiadmin/layui/layui.js')}}"></script>
<script>
    layui.config({
        base: '../../../layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form','iconPicker'], function () {
        var $ = layui.$
            , form = layui.form
            , iconPicker = layui.iconPicker;

        iconPicker.render({
            // 选择器，推荐使用input
            elem: '#iconPicker',
            // 数据类型：fontClass/unicode，推荐使用fontClass
            type: 'fontClass',
            // 是否开启搜索：true/false
            search: false,
            // 是否开启分页
            page: true,
            // 每页显示数量，默认12
            limit: 12,
            // 点击回调
            click: function (data) {
                document.getElementById('iconPicker').value(data.icon)
                console.log(data);
            }
        });
        //监听提交
        form.on('submit(layuiadmin-app-form-submit)', function (data) {
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
            $.ajax({
                url: '/menu?token=' + field.token, //实际使用请改成服务端真实接口
                type: 'post',
                data: field,
                success: function (res) {
                    if (res.data.code == 1001) {
                        parent.layui.table.reload('LAY-app-content-list'); //重载表格
                        parent.layer.close(index); //再执行关闭
                    } else {
                        parent.layui.table.reload('LAY-app-content-list'); //重载表格
                        parent.layer.close(index); //再执行关闭
                    }
                }
            });


        });
    })
</script>
</body>
</html>
