

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layuiAdmin 角色管理</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
  <link rel="stylesheet" href="{{url('src/layuiadmin/style/admin.css')}}" media="all">
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">
        <div class="layui-form-item">
          <div class="layui-inline">
            角色筛选
          </div>
          <div class="layui-inline">
            <select name="role_id" lay-filter="LAY-user-adminrole-type">
              <option value="">全部角色</option>
              @foreach($role as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
        <input type="hidden" name="token" id="token" value="{{$token}}">
      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
{{--          <button class="layui-btn layuiadmin-btn-role" data-type="batchdel">删除</button>--}}
          <button class="layui-btn layuiadmin-btn-role" data-type="add">添加</button>
        </div>

        <table id="LAY-user-back-role" lay-filter="LAY-user-back-role"></table>
        <script type="text/html" id="buttonTpl">

            <button class="layui-btn layui-btn-xs">已审核</button>
{{--            <button class="layui-btn layui-btn-primary layui-btn-xs">未审核</button>--}}
        </script>
        <script type="text/html" id="table-useradmin-admin">
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
          <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
        </script>
      </div>
    </div>
  </div>

 <script src="{{url('src/layuiadmin/layui/layui.js')}}"></script>
  <script>
  layui.config({
    base: '../../../layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'useradmin', 'table'], function(){
    var $ = layui.$
    ,form = layui.form
    ,table = layui.table;
      var token = $('#token').val();

    //搜索角色
    form.on('select(LAY-user-adminrole-type)', function(data){
      //执行重载
        var field = {
            role_id: data.value
        }
        $.ajax({
            url: 'role?type=1&token=' + token + '&role_id=' + data.value,
            type: 'get',
            success: function (data) {
                table.reload('LAY-user-back-role', {
                    where: field
                });
            }
        });

    });

    //事件
    var active = {
      batchdel: function(){
        var checkStatus = table.checkStatus('LAY-user-back-role')
        ,checkData = checkStatus.data; //得到选中的数据

        if(checkData.length === 0){
          return layer.msg('请选择数据');
        }

      },
      add: function(){
        layer.open({
          type: 2
          ,title: '添加新角色'
          ,content: 'role/create?token='+token
          ,area: ['500px', '480px']
          ,btn: ['确定', '取消']
          ,yes: function(index, layero){
            var iframeWindow = window['layui-layer-iframe'+ index]
            ,submit = layero.find('iframe').contents().find("#LAY-user-role-submit");

            //监听提交
            iframeWindow.layui.form.on('submit(LAY-user-role-submit)', function(data){
              var field = data.field; //获取提交的字段

                $.ajax({
                    url: 'role?token='+token,
                    type:'post',
                    data: field,
                    success :function(data){
                        table.reload('LAY-user-back-role');
                        layer.close(index); //关闭弹层
                    }
                });


            });

            submit.trigger('click');
          }
        });
      }
    }

      layui.define(['table', 'form'], function(exports){
          var $ = layui.$
              ,table = layui.table
              ,form = layui.form;
          var token = $('#token').val()

          //角色管理
          table.render({
              elem: '#LAY-user-back-role'
              ,url: 'role?type=1&token='+token //模拟接口
              ,cols: [[
                  {type: 'checkbox', fixed: 'left'}
                  ,{field: 'id', width: 80, title: 'ID', sort: true}
                  ,{field: 'name', title: '角色名'}
                  // ,{field: 'limits', title: '拥有权限'}
                  ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-useradmin-admin'}
              ]]
              ,text: '对不起，加载出现异常！'
          });

          //监听工具条
          table.on('tool(LAY-user-back-role)', function(obj){
              var data = obj.data;
              var token = $('#token').val()
              if(obj.event === 'del'){
                  layer.confirm('确定删除此角色？', function(index){
                      $.ajax({
                          url: '/role/' + data.id + '?token=' + token,
                          type: 'delete',
                          success: function (data) {
                              table.reload('LAY-user-back-role');
                              layer.msg('已删除');
                              layer.close(index);
                          }
                      });
                  });
              }else if(obj.event === 'edit'){
                  var tr = $(obj.tr);
                  layer.open({
                      type: 2
                      ,title: '编辑角色'
                      ,content: 'role/'+data.id +'?token='+ token
                      ,area: ['500px', '480px']
                      ,btn: ['确定', '取消']
                      ,yes: function(index, layero){
                          var iframeWindow = window['layui-layer-iframe'+ index]
                              ,submit = layero.find('iframe').contents().find("#LAY-user-role-edit");

                          //监听提交
                          iframeWindow.layui.form.on('submit(LAY-user-role-edit)', function(data){
                              var field = data.field; //获取提交的字段
                              $.ajax({
                                  url: 'role/'+field.id+'?token='+token,
                                  type:'put',
                                  data: field,
                                  success :function(data){
                                      table.reload('LAY-user-back-role'); //数据刷新
                                      layer.close(index); //关闭弹层
                                  }
                              });

                          });

                          submit.trigger('click');
                      }
                      ,success: function(layero, index){

                      }
                  })
              }
          });

          exports('useradmin', {})
      });

    $('.layui-btn.layuiadmin-btn-role').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });
  });
  </script>
</body>
</html>

