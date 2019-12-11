

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>设置我的密码</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
  <link rel="stylesheet" href="{{url('src/layuiadmin/style/admin.css')}}" media="all">
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">修改密码</div>
          <div class="layui-card-body" pad15>

            <div class="layui-form" lay-filter="">
              <div class="layui-form-item">
                <label class="layui-form-label">当前密码</label>
                <div class="layui-input-inline">
                  <input type="password" name="oldPassword" lay-verify="required" lay-verType="tips" class="layui-input">
                </div>
              </div>
                <input type="hidden" name="token" id="token" value="{{$token}}">
                <input type="hidden" name="id" value="{{$user->id}}">
{{csrf_field()}}
                <div class="layui-form-item">
                <label class="layui-form-label">新密码</label>
                <div class="layui-input-inline">
                  <input type="password" name="password" lay-verify="pass" lay-verType="tips" autocomplete="off" id="LAY_password" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">6到16个字符</div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">确认新密码</label>
                <div class="layui-input-inline">
                  <input type="password" name="repassword" lay-verify="repass" lay-verType="tips" autocomplete="off" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="setmypass">确认修改</button>
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
      layui.define(['form', 'upload'], function(exports){
          var $ = layui.$
              ,layer = layui.layer
              ,laytpl = layui.laytpl
              ,setter = layui.setter
              ,view = layui.view
              ,admin = layui.admin
              ,form = layui.form
              ,upload = layui.upload;

          var $body = $('body');

          //自定义验证
          form.verify({
              pass: [
                  /^[\S]{6,12}$/
                  ,'密码必须6到12位，且不能出现空格'
              ]

              //确认密码
              ,repass: function(value){
                  if(value !== $('#LAY_password').val()){
                      return '两次密码输入不一致';
                  }
              }
          });

          //设置密码
          form.on('submit(setmypass)', function(obj){
              var token = $('#token').val();
              $.ajax({
                  url: 'passwordEdit?token='+token,
                  type:'post',
                  data: obj.field,
                  success :function(data){
                      console.log(data)
                      if (data.data.code == 1001){
                          //登入成功的提示与跳转
                          layer.msg(data.msg, {
                              offset: '15px'
                              ,icon: 1
                              ,time: 1000
                          }, function(){
                              location.href = 'password?token='+token; //后台主页
                          });
                      }else{
                          layer.msg(data.msg, {
                              offset: '15px'
                              ,icon: 1
                              ,time: 1000
                          }, function(){
                              location.href = 'password?token='+token; //后台主页
                          });
                      }
                  }
              });
              return true;
          });
          //对外暴露的接口
          exports('set', {});
      });

  </script>
</body>
</html>
