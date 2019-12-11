

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>设置我的资料</title>
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
          <div class="layui-card-header">设置我的资料</div>
          <div class="layui-card-body" pad15>

            <div class="layui-form" lay-filter="">
              <div class="layui-form-item">
                <label class="layui-form-label">我的角色</label>
                <div class="layui-input-inline">
                  <select name="role" lay-verify="" disabled="disabled">
                      @foreach($role as  $v)
                          <option value="{{$v->id}}" @if(isset($role_id) && $role_id == $v->id) selected @endif >{{$v->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="layui-form-mid layui-word-aux">当前角色不可更改为其它角色</div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-inline">
                  <input type="text" name="name" value="{{$user->name}}" readonly class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">不可修改。一般用于后台登入名</div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">昵称</label>
                <div class="layui-input-inline">
                  <input type="text" name="nickname" value="{{$user->nickname}}" lay-verify="nickname" autocomplete="off" placeholder="请输入昵称" class="layui-input">
                </div>
              </div>
                <input type="hidden" name="token" id="token" value="{{$token}}">
                <input type="hidden" name="id" value="{{$user->id}}">
                {{csrf_field()}}
{{--                暂时用不上--}}
{{--              <div class="layui-form-item">--}}
{{--                <label class="layui-form-label">性别</label>--}}
{{--                <div class="layui-input-block">--}}
{{--                  <input type="radio" name="sex" value="男" title="男">--}}
{{--                  <input type="radio" name="sex" value="女" title="女" checked>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="layui-form-item">--}}
{{--                <label class="layui-form-label">头像</label>--}}
{{--                <div class="layui-input-inline">--}}
{{--                  <input name="avatar" lay-verify="required" id="LAY_avatarSrc" placeholder="图片地址" value="http://cdn.layui.com/avatar/168.jpg" class="layui-input">--}}
{{--                </div>--}}
{{--                <div class="layui-input-inline layui-btn-container" style="width: auto;">--}}
{{--                  <button type="button" class="layui-btn layui-btn-primary" id="LAY_avatarUpload">--}}
{{--                    <i class="layui-icon">&#xe67c;</i>上传图片--}}
{{--                  </button>--}}
{{--                  <button class="layui-btn layui-btn-primary" layadmin-event="avartatPreview">查看图片</button >--}}
{{--                </div>--}}
{{--             </div>--}}
{{--              <div class="layui-form-item">--}}
{{--                <label class="layui-form-label">手机</label>--}}
{{--                <div class="layui-input-inline">--}}
{{--                  <input type="text" name="cellphone" value="" lay-verify="phone" autocomplete="off" class="layui-input">--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="layui-form-item">--}}
{{--                <label class="layui-form-label">邮箱</label>--}}
{{--                <div class="layui-input-inline">--}}
{{--                  <input type="text" name="email" value="" lay-verify="email" autocomplete="off" class="layui-input">--}}
{{--                </div>--}}
{{--              </div>--}}


              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-block">
                  <textarea name="remark" id="remark" placeholder="请输入内容" class="layui-textarea">{{$user->remark}}</textarea>
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="setmyinfo">确认修改</button>
                  <button type="reset" class="layui-btn layui-btn-primary">重新填写</button>
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
              nickname: function(value, item){ //value：表单的值、item：表单的DOM对象
                  if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                      return '用户名不能有特殊字符';
                  }
                  if(/(^\_)|(\__)|(\_+$)/.test(value)){
                      return '用户名首尾不能出现下划线\'_\'';
                  }
                  if(/^\d+\d+\d$/.test(value)){
                      return '用户名不能全为数字';
                  }
              }
          });

          //设置我的资料
          form.on('submit(setmyinfo)', function(obj){
              //提交修改
              var token = $('#token').val();
              $.ajax({
                  url: 'infoEdit?token='+token,
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
                              location.href = 'info?token='+token; //后台主页
                          });
                      }else{
                          layer.msg(data.msg, {
                              offset: '15px'
                              ,icon: 1
                              ,time: 1000
                          }, function(){
                              location.href = 'info?token='+token; //后台主页
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
