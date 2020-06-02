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
                    <div class="layui-card-header">短信设置</div>
                    <div class="layui-tab layui-tab-brief" lay-filter="component-tabs-hash">
                        <ul class="layui-tab-title">
                            <li lay-id="11"
                                @if(isset($system['default']) && $system['default'] == 'feige') class="layui-this" @endif>
                                飞鸽传书
                            </li>
                            <li lay-id="22"
                                @if(isset($system['default']) && $system['default'] == 'aliyun') class="layui-this" @endif>
                                阿里云
                            </li>
                            <li lay-id="33"
                                @if(isset($system['default']) && $system['default'] == 'juhe') class="layui-this" @endif>
                                聚合
                            </li>
                        </ul>
                        <div class="layui-tab-content" style="height: 100%;">
                            <div class="layui-tab-item layui-show">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">飞鸽账号</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="feige[account]"
                                               value="{{$system['feige']['account'] ?? ''}}" autocomplete="off"
                                               class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">飞鸽秘钥</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="feige[Pwd]" value="{{$system['feige']['Pwd'] ?? ''}}"
                                               autocomplete="off"
                                               class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">飞鸽签名</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="feige[SignId]"
                                               value="{{$system['feige']['SignId'] ?? ''}}"
                                               autocomplete="off" class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">飞鸽验证码模板ID</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="feige[TemplateId]"
                                               value="{{$system['feige']['TemplateId'] ?? ''}}" autocomplete="off"
                                               class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">飞鸽订单通知模板ID</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="feige[TemplateId1]"
                                               value="{{$system['feige']['TemplateId1'] ?? ''}}" autocomplete="off"
                                               class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">飞鸽付款通知模板ID</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="feige[TemplateId2]"
                                               value="{{$system['feige']['TemplateId2'] ?? ''}}" autocomplete="off"
                                               class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                            </div>
                            <div class="layui-tab-item">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">阿里云KEY</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="aliyun[access_key]"
                                               value="{{$system['aliyun']['access_key'] ?? ''}}" class="layui-input"
                                               style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">阿里云SECRET</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="aliyun[access_secret]"
                                               value="{{$system['aliyun']['access_secret'] ?? ''}}" class="layui-input"
                                               style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">阿里云签名</label>
                                    <div class="layui-input-inline" style="width: 80px;">
                                        <input type="text" name="aliyun[sign_name]" lay-verify=""
                                               value="{{$system['aliyun']['sign_name'] ?? ''}}" class="layui-input"
                                               style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">阿里云模板ID</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="aliyun[id]" value="{{$system['aliyun']['id'] ?? ''}}"
                                               lay-verify=""
                                               autocomplete="off" class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                            </div>
                            <div class="layui-tab-item" >
                                <div class="layui-form-item">
                                    <label class="layui-form-label">聚合KEY</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="juhe[app_key]"
                                               value="{{$system['juhe']['app_key'] ?? ''}}"
                                               autocomplete="off"
                                               class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">聚合模板ID</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="juhe[id]" value="{{$system['juhe']['id'] ?? ''}}"
                                               autocomplete="off" class="layui-input" style="width: 200%">
                                    </div>
                                </div>
                            </div>
                            {{csrf_field()}}
                            <input type="hidden" name="token" id="token" value="{{$token}}">
                            <input type="hidden" name="id" id="id" value="{{$id}}">
                            <div class="layui-form-item" lay-filter="sex">
                                <label class="layui-form-label">选择短信</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="default" value="aliyun" title="阿里云"
                                           @if(isset($system['default']) && $system['default'] == 'aliyun') checked @endif>
                                    <input type="radio" name="default" value="juhe" title="聚合"
                                           @if(isset($system['default']) && $system['default'] == 'juhe') checked @endif>
                                    <input type="radio" name="default" value="feige" title="飞鸽传书"
                                           @if(isset($system['default']) && $system['default'] == 'feige') checked @endif>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="set_system_sms">确认保存</button>
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
        form.on('submit(set_system_sms)', function(obj){
            var data = obj.field;
            console.log(obj)
            $.ajax({
                url: '/sms/'+data.id+'?token=' + data.token, //实际使用请改成服务端真实接口
                type: 'put',
                data: data,
                success: function (res) {
                    location.href = 'sms?token='+data.token; //重载表格
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
