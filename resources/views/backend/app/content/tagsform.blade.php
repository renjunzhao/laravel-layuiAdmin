<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 分类管理 iframe 框</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{url('src/layuiadmin/style/admin.css')}}" media="all">

</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-form-tags" id="layuiadmin-app-form-tags"
     style="padding-top: 30px; text-align: center;">
    <div class="layui-form-item">
        <label class="layui-form-label">分类名</label>
        <div class="layui-input-inline">
            <input type="text" name="name" lay-verify="required" placeholder="请输入分类名" autocomplete="off"
                   class="layui-input" value="{{isset($category) ? $category['name'] : ''}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-inline">
            <input type="text" name="sort" lay-verify="required" placeholder="请输入..." autocomplete="off"
                   class="layui-input" oninput="value=value.replace(/[^\d]/g,'')" value="{{isset($category) ? $category['sort'] : 0}}">
        </div>
    </div>
    <div class="layui-form-item" lay-filter="sex">
        <label class="layui-form-label">是否显示</label>
        <div class="layui-input-block">
            <input type="radio" name="is_show" value="1" title="是"
                   @if(isset($category) && $category['is_show'] == 1) checked @endif>
            <input type="radio" name="is_show" value="2" title="否"
                   @if(isset($category) && $category['is_show'] == 2) checked @endif>
        </div>
    </div>
    {{csrf_field()}}
    <input type="hidden" name="token" value="{{$token}}" id="token">
    <input type="hidden" name="id" value="{{isset($category) ? $category['id'] : ''}}" id="id">
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
    }).use(['index', 'form'], function () {
        var $ = layui.$
            , form = layui.form;
        //监听提交
        form.on('submit(layuiadmin-app-form-submit)', function (data) {
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            $.ajax({
                url: '/category?token='+token, //实际使用请改成服务端真实接口
                type:'post',
                data: field,
                success: function(res){
                    parent.layui.table.reload('LAY-app-content-tags'); //重载表格
                    parent.layer.close(index); //再执行关闭
                }
            });
        });
    })
</script>
</body>
</html>
