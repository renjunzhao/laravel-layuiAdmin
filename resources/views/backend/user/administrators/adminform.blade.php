

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layuiAdmin 管理员 iframe 框</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
</head>
<body>

  <div class="layui-form" lay-filter="layuiadmin-form-admin" id="layuiadmin-form-admin" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
      <label class="layui-form-label">登录名</label>
      <div class="layui-input-inline">
        <input type="text" name="name" lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input" value="@if(isset($userObj) && $userObj != "") {{$userObj->name}} @endif">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">昵称</label>
      <div class="layui-input-inline">
        <input type="text" name="nickname" lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input" value="@if(isset($userObj) && $userObj != "") {{$userObj->nickname}} @endif">
      </div>
    </div>
      @if($userObj == "")
      <div class="layui-form-item">
          <label class="layui-form-label">登陆密码</label>
          <div class="layui-input-inline">
              <input type="password" name="password" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
          </div>
      </div>
      @endif
    <div class="layui-form-item">
      <label class="layui-form-label">角色</label>
      <div class="layui-input-inline">
          <select name="role_id" lay-verify="">
              <option value="">请选择角色</option>
              @if(isset($role))
                  @foreach($role as $v)
                      <option value="{{$v->id}}"
                              @if(isset($role_id) && $role_id == $v->id) selected @endif> {{$v->name}}
                      </option>
                  @endforeach
              @endif
          </select>
      </div>
    </div>
      {{csrf_field()}}
      <input type="hidden" name="token" value="{{$token}}" id="token">
      <input type="hidden" name="id" value="@if(isset($userObj) && $userObj != "") {{$userObj->id}} @endif" id="token">
      <div class="layui-form-item" lay-filter="sex">
          <label class="layui-form-label">是否禁用</label>
          <div class="layui-input-block">
              <input type="radio" name="is_isable" value="1" title="禁用" @if(isset($userObj) && $userObj != "" && $userObj->is_isable == 1) checked @endif>
              <input type="radio" name="is_isable" value="2" title="正常" @if(isset($userObj) && $userObj != "" && $userObj->is_isable == 2) checked @endif>
          </div>
      </div>
    <div class="layui-form-item layui-hide">
      <input type="button" lay-submit lay-filter="LAY-user-front-submit" id="LAY-user-back-submit" value="确认">
    </div>
  </div>

  <script src="{{url('src/layuiadmin/layui/layui.js')}}"></script>
  <script>
      layui.config({
        base: '../../../layuiadmin/' //静态资源所在路径
      }).extend({
        index: 'lib/index' //主入口模块
      }).use(['index', 'form'], function(){
        var $ = layui.$
        ,form = layui.form ;
          form.render();

          //提交
          form.on('submit(LAY-user-front-submit)', function(obj){
              var token = $('#token').val()
              console.log(obj.field)
              if (obj.field.id){
                  $.ajax({
                      url: 'editApi?type=2&token=' + token, //实际使用请改成服务端真实接口
                      type:'post',
                      data: obj.field,
                      success: function(res){
                          console.log(res)
                          if (res.data.code == 1001){
                              //登入成功的提示与跳转
                              layer.msg('更新成功', {
                                  offset: '15px'
                                  ,icon: 1
                                  ,time: 1000
                              }, function(){
                                  location.href = 'adminUserEditForm?token='+token+'&id='+obj.field.id; //后台主页
                              });
                          }else{
                              layer.msg(res.msg, {
                                  offset: '15px'
                                  ,icon: 1
                                  ,time: 1000
                              }, function(){
                                  location.href = 'adminUserEditForm?token='+token+'&id='+obj.field.id; //后台主页
                              });
                          }
                      }
                  });
              }else {
                  $.ajax({
                      url: 'createApi?type=2&token='+token, //实际使用请改成服务端真实接口
                      type:'post',
                      data: obj.field,
                      success: function(res){
                          console.log(res)
                          if (res.data.code == 1001){
                              //登入成功的提示与跳转
                              layer.msg('创建成功', {
                                  offset: '15px'
                                  ,icon: 1
                                  ,time: 1000
                              }, function(){
                                  location.href = 'adminUserEditForm?token='+token; //后台主页
                              });
                          }else{
                              layer.msg(res.msg, {
                                  offset: '15px'
                                  ,icon: 1
                                  ,time: 1000
                              }, function(){
                                  location.href = 'adminUserEditForm?token='+token; //后台主页
                              });
                          }
                      }
                  });
              }



          });
      })
  </script>
</body>
</html>
