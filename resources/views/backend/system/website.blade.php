<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>网站设置</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{url('src/layuiadmin/style/admin.css')}}" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">网站设置</div>
                <div class="layui-card-body" pad15>

                    <div class="layui-form" wid100 lay-filter="">
                        <div class="layui-tab layui-tab-brief" lay-filter="component-tabs-hash">
                            <ul class="layui-tab-title">
                                <li lay-id="11" class="layui-this">
                                    基本设置
                                </li>
                                <li lay-id="22">
                                    QQ授权信息
                                </li>
                            </ul>
                            <div class="layui-tab-content" style="height: 100%;">
                                <div class="layui-tab-item layui-show">
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">网站标题</label>
                                        <div class="layui-input-inline">
                                            <input type="text" name="title" lay-verify="required" placeholder="请输入标题" autocomplete="off"
                                                   class="layui-input" value="{{$setting->title}}">
                                        </div>
                                    </div>
                                    <div class="">
                                        <label class="layui-form-label">协议</label>
                                        <div class="layui-input-inline">
            <textarea name="xieyi" lay-verify="content" autocomplete="off"
                      class="layui-textarea" id="xieyi">{{$setting->xieyi}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="layui-tab-item">
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">APP_ID</label>
                                        <div class="layui-input-inline">
                                            <input type="text" name="qq[app_id]"
                                                   value="{{$system->qq['app_id'] ?? ''}}" autocomplete="off"
                                                   class="layui-input" style="width: 200%">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">APP_SECRET</label>
                                        <div class="layui-input-inline">
                                            <input type="text" name="qq[secret]" value="{{$system->qq['secret'] ?? ''}}"
                                                   autocomplete="off"
                                                   class="layui-input" style="width: 200%">
                                        </div>
                                    </div>
                                </div>

                                {{csrf_field()}}
                                <input type="hidden" name="token" id="token" value="{{$token}}">
                                <input type="hidden" name="id" id="id" value="{{$setting->id}}">
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <button class="layui-btn" lay-submit lay-filter="set_website">确认保存</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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
            , admin = layui.admin
            , element = layui.element
            , router = layui.router()
            , layer = layui.layer
            , form = layui.form;

    });

</script>
<script>
    layui.define(['form', 'upload', 'layedit'], function (exports) {
        var $ = layui.$
            , layer = layui.layer
            , form = layui.form
            , layedit = layui.layedit;
        var index = layedit.build('xieyi', {
            height: 300
        });
        form.verify({
            content: function (value) {
                layedit.sync(index);
            },
        });

        //网站设置
        form.on('submit(set_website)', function (obj) {
            var data = obj.field;
            //提交修改
            $.ajax({
                url: 'system/' + data.id + '?token=' + data.token,
                type: 'put',
                data: data,
                success: function () {
                    location.href = 'system?token=' + data.token; //重载表格
                }
            });
            return false;
        });
        //对外暴露的接口
        exports('set', {});
    });

</script>
</body>
</html>
