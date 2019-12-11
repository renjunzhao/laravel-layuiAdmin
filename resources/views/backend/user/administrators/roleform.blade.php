

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layuiAdmin 角色管理 iframe 框</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
</head>
<body>

  <div class="layui-form" lay-filter="layuiadmin-form-role" id="layuiadmin-form-role" style="padding: 20px 30px 0 0;">
      <div class="layui-form-item">
          <label class="layui-form-label">角色名</label>
          <div class="layui-input-inline">
              <input type="text" name="name" lay-verify="required" placeholder="请输入角色名" autocomplete="off" class="layui-input" value="@if(isset($role)) {{$role->name}} @endif">
          </div>
      </div>
    <div class="layui-form-item">
      <label class="layui-form-label">权限范围</label>
      <div class="layui-input-block">
          @if(isset($permission))
              @foreach($permission as $v)
                  <input type="checkbox" name="permission[]" lay-skin="primary" title="{{$v->name}}" value="{{$v->id}}" @if(isset($arr) && in_array($v->id,$arr)) checked @endif >
              @endforeach
          @endif
      </div>
    </div>
      <input type="hidden" name="token" id="token" value="{{$token}}">
      <input type="hidden" name="id" id="id" value="{{isset($role) ? $role->id : ''}}">
    <div class="layui-form-item layui-hide">
      <button class="layui-btn" lay-submit lay-filter="LAY-user-role-submit" id="LAY-user-role-submit">提交</button>
      <button class="layui-btn" lay-submit lay-filter="LAY-user-role-edit" id="LAY-user-role-edit">编辑</button>
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
  })
  </script>
</body>
</html>
