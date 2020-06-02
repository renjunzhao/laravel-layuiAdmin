

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 主页示例模板二</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{url('src/layuiadmin/style/admin.css')}}" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-fluid">
            <div class="layadmin-tips">
                <i class="layui-icon" face>&#xe62e;</i>
                <div class="layui-text">
                    <h1>
                        <span class="layui-anim layui-anim-loop layui-anim-rotate"></span>
                        <span class="layui-anim layui-anim-loop layui-anim-rotate"></span>
                        <span class="layui-anim layui-anim-loop layui-anim-rotate"></span>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{url('src/layuiadmin/layui/layui.js')}}"></script>
<script>
    layui.config({
        base: '../../layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'sample']);
</script>
</body>
</html>
