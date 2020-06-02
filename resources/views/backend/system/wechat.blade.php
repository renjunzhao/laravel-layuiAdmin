<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>短信服务</title>
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
                <div class="layui-form" wid100 lay-filter="">
                    <div class="layui-card-header">微信设置</div>
                    <div class="layui-tab layui-tab-brief" lay-filter="component-tabs-hash">
                        <ul class="layui-tab-title">
                            <li lay-id="11" class="layui-this">
                                公众号
                            </li>
                            <li lay-id="22">
                                支付
                            </li>
                        </ul>
                        <div class="layui-tab-content" style="height: 100%;">
                            <div class="layui-tab-item layui-show">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">APP_ID</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="official_account[app_id]"
                                               value="{{$system['official_account']['app_id'] ?? ''}}" autocomplete="off"
                                               class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">APP_SECRET</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="official_account[secret]" value="{{$system['official_account']['secret'] ?? ''}}"
                                               autocomplete="off"
                                               class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">TOKEN</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="official_account[token]"
                                               value="{{$system['official_account']['token'] ?? ''}}"
                                               autocomplete="off" class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">AES_KEY</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="official_account[aes_key]"
                                               value="{{$system['official_account']['aes_key'] ?? ''}}" autocomplete="off"
                                               class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                            </div>
                            <div class="layui-tab-item">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">APP_ID</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="payment[app_id]"
                                               value="{{$system['payment']['app_id'] ?? ''}}" class="layui-input"
                                               style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">商户id</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="payment[mch_id]"
                                               value="{{$system['payment']['mch_id'] ?? ''}}" class="layui-input"
                                               style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">秘钥</label>
                                    <div class="layui-input-inline" style="width: 80px;">
                                        <input type="text" name="payment[key]" lay-verify=""
                                               value="{{$system['payment']['key'] ?? ''}}" class="layui-input"
                                               style="width: 400%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">回调地址</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="payment[notify_url]" value="{{$system['payment']['notify_url'] ?? ''}}"
                                               lay-verify=""
                                               autocomplete="off" class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                            </div>
                            {{csrf_field()}}
                            <input type="hidden" name="token" id="token" value="{{$token}}">
                            <input type="hidden" name="id" id="id" value="{{$id}}">
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="set_system_wechat">确认保存</button>
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
    layui.define(['form'], function(exports){
        var $ = layui.$
            ,layer = layui.layer
            ,form = layui.form;



        //邮件服务
        form.on('submit(set_system_wechat)', function(obj){
            var data = obj.field;
            console.log(obj)
            $.ajax({
                url: '/wechat/'+data.id+'?token=' + data.token, //实际使用请改成服务端真实接口
                type: 'put',
                data: data,
                success: function (res) {
                    location.href = 'wechat?token='+data.token; //重载表格
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
