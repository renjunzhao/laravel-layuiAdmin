<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 网站用户 iframe 框</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin"
     style="padding: 20px 0 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" name="username" lay-verify="required" placeholder="请输入用户名" autocomplete="off"
                   class="layui-input" value="{{$userObj->username}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">手机号码</label>
        <div class="layui-input-inline">
            <input type="text" name="phone" lay-verify="phone" placeholder="请输入号码" autocomplete="off"
                   class="layui-input" value="{{$userObj->phone}}">
        </div>
    </div>
    {{--      <div class="layui-form-item">--}}
    {{--      <label class="layui-form-label">密码</label>--}}
    {{--      <div class="layui-input-inline">--}}
    {{--        <input type="text" name="password" lay-verify="password" placeholder="请输入密码" autocomplete="off" class="layui-input">--}}
    {{--      </div>--}}
    {{--    </div>--}}
    <div class="layui-form-item">
        <label class="layui-form-label">邮箱</label>
        <div class="layui-input-inline">
            <input type="text" name="email" lay-verify="email" placeholder="请输入邮箱" autocomplete="off"
                   class="layui-input" value="{{$userObj->email}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">身份证号</label>
        <div class="layui-input-inline">
            <input type="text" name="id_card" lay-verify="id_card" placeholder="请输入身份证号" autocomplete="off"
                   class="layui-input" value="{{$userObj->id_card}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">国籍</label>
        <div class="layui-input-inline">
            <input type="text" name="nationality" lay-verify="nationality" placeholder="请输入国籍" autocomplete="off"
                   class="layui-input" value="{{$userObj->nationality}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">区号</label>
        <div class="layui-input-inline">
            <input type="text" name="area_code" lay-verify="area_code" placeholder="请输入区号" autocomplete="off"
                   class="layui-input" value="{{$userObj->area_code}}">
        </div>
    </div>
    {{csrf_field()}}
    <input type="hidden" name="token" value="{{$token}}" id="token">
    <input type="hidden" name="id" value="{{$userObj->id}}" id="id">
    <div class="layui-form-item">
        <label class="layui-form-label">头像</label>
        <div class="layui-input-inline">
            <input type="text" name="headimgurl" placeholder="请上传图片" autocomplete="off"
                   class="layui-input" value="{{$userObj->headimgurl}}">
        </div>
        <button style="float: left;" type="button" class="layui-btn" id="layuiadmin-upload-useradmin">上传图片</button>
    </div>
    <div class="layui-form-item" lay-filter="is_lock">
        <label class="layui-form-label">是否锁定</label>
        <div class="layui-input-block">
            <input type="radio" name="is_lock" value="1" title="是" @if($userObj->is_lock == 1) checked @endif>
            <input type="radio" name="is_lock" value="2" title="否" @if($userObj->is_lock == 2) checked @endif>
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-user-front-submit" id="LAY-user-front-submit" value="确认">
    </div>
</div>

<script src="{{url('src/layuiadmin/layui/layui.js')}}"></script>
<script>
    layui.config({
        base: '../../../layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form', 'upload'], function () {

        var $ = layui.$
            , form = layui.form
            , upload = layui.upload;
        var token = $('#token').val()
        upload.render({
            elem: '#layuiadmin-upload-useradmin'
            , url: 'upload?token='+token
            , accept: 'images'
            , method: 'post'
            , acceptMime: 'image/*'
            , done: function (res) {
                $(this.item).prev("div").children("input").val(res.data.url)
            }
        });

    })
</script>
</body>
</html>
