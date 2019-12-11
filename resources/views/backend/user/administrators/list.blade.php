

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layuiAdmin 后台管理员</title>
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
            <label class="layui-form-label">登录名</label>
            <div class="layui-input-block">
              <input type="text" name="name" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
{{--          <div class="layui-inline">--}}
{{--            <label class="layui-form-label">手机</label>--}}
{{--            <div class="layui-input-block">--}}
{{--              <input type="text" name="telphone" placeholder="请输入" autocomplete="off" class="layui-input">--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <div class="layui-inline">--}}
{{--            <label class="layui-form-label">邮箱</label>--}}
{{--            <div class="layui-input-block">--}}
{{--              <input type="text" name="email" placeholder="请输入" autocomplete="off" class="layui-input">--}}
{{--            </div>--}}
{{--          </div>--}}
            <input type="hidden" name="token" id="token" value="{{$token}}">
          <div class="layui-inline">
            <button class="layui-btn layuiadmin-btn-admin" lay-submit lay-filter="LAY-user-back-search">
              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
          <button class="layui-btn layuiadmin-btn-admin" data-type="batchdel">删除</button>
          <button class="layui-btn layuiadmin-btn-admin" data-type="add">添加</button>
        </div>
        {{csrf_field()}}
        <table id="LAY-user-back-manage" lay-filter="LAY-user-back-manage"></table>
        <script type="text/html" id="buttonTpl">
            <button class="layui-btn layui-btn-xs">已审核</button>
            <button class="layui-btn layui-btn-primary layui-btn-xs">未审核</button>
        </script>
        <script type="text/html" id="table-useradmin-admin">
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
{{--            <a class="layui-btn layui-btn-disabled layui-btn-xs"><i class="layui-icon layui-icon-delete"></i>删除</a>--}}
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

    //监听搜索
    form.on('submit(LAY-user-back-search)', function(data){
      var field = data.field;
        $.ajax({
            url: 'listApi?type=2&token='+token,
            type:'get',
            data: field,
            success :function(data){
                table.reload('LAY-user-back-manage', {where: field});
            }
        });
    });

    //事件
    var active = {
      batchdel: function(){
        var checkStatus = table.checkStatus('LAY-user-back-manage')
        ,checkData = checkStatus.data; //得到选中的数据

        if(checkData.length === 0){
          return layer.msg('请选择数据');
        }
          layer.confirm('确定删除吗？', function() {
              console.log(checkStatus)
              //执行 Ajax 后重载
              $.ajax({
                  url: 'batchDelApi?type=2&token='+token,
                  type:'get',
                  data: {"arr": checkData},
                  success :function(data){
                      if (data.data.code == 1001){
                          table.reload('LAY-user-back-manage');
                          layer.msg('已删除');
                      }else{
                          table.reload('LAY-user-back-manage');
                          layer.msg('删除失败');
                      }
                  }
              });

          });
      }
      ,add: function(){
        layer.open({
          type: 2
          ,title: '添加管理员'
          ,content: 'adminUserEditForm?token='+token
          ,area: ['420px', '420px']
          ,btn: ['确定', '取消']
          ,yes: function(index, layero){
            var iframeWindow = window['layui-layer-iframe'+ index]
            ,submitID = 'LAY-user-back-submit'
            ,submit = layero.find('iframe').contents().find('#'+ submitID);

            //监听提交
            iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
              var field = data.field; //获取提交的字段

              //提交 Ajax 成功后，静态更新表格中的数据
                table.reload('LAY-user-front-submit');
                layer.close(index);
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
          //管理员管理
          table.render({
              elem: '#LAY-user-back-manage'
              ,url: 'listApi?type=2&token='+token //模拟接口
              ,cols: [[
                  {type: 'checkbox', fixed: 'left'}
                  ,{field: 'id', width: 80, title: 'ID', sort: true}
                  ,{field: 'name', title: '登录名'}
                  ,{field: 'nickname', title: '昵称'}
                  ,{field: 'ip', title: 'IP'}
                  ,{field: 'role_name', title: '角色'}
                  ,{field: 'is_isable', title:'是否禁用',  minWidth: 80, align: 'center',templet: function(rec){
                          if(rec.is_isable == 2){
                              return '<button class="layui-btn layui-btn-xs">正常</button>';
                          }else if(rec.is_isable == 1){
                              return '<button class="layui-btn layui-btn-primary layui-btn-xs">已禁用</button>';
                          }else{
                              return rec.is_lock;
                          }
                      }}
                  ,{field: 'created_at', title: '加入时间', sort: true}
                  ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-useradmin-admin'}
              ]]
              ,page: true
              ,limit: 30
              ,height: 'full-220'
              ,text: '对不起，加载出现异常！'
          });

          //监听工具条
          table.on('tool(LAY-user-back-manage)', function(obj){
              var data = obj.data;
              if(obj.event === 'del'){
                  layer.confirm('确定删除此管理员？', function(index){
                      console.log(obj)
                      $.ajax({
                          url: 'delApi?type=2&token='+token,
                          type:'post',
                          data: obj.data,
                          success :function(data){
                              if (data.data.code == 1001){
                                  table.reload('LAY-user-back-manage');
                                  layer.msg('已删除');
                              }else{
                                  table.reload('LAY-user-back-manage');
                                  layer.msg('删除失败');
                              }
                          }
                      });
                  });
              }else if(obj.event === 'edit'){
                  var tr = $(obj.tr);

                  layer.open({
                      type: 2
                      ,title: '编辑管理员'
                      ,content: 'adminUserEditForm?token='+token+'&id='+data.id
                      ,area: ['420px', '420px']
                      ,btn: ['确定', '取消']
                      ,yes: function(index, layero){
                          var iframeWindow = window['layui-layer-iframe'+ index]
                              ,submitID = 'LAY-user-back-submit'
                              ,submit = layero.find('iframe').contents().find('#LAY-user-back-submit');

                          //监听提交
                          iframeWindow.layui.form.on('submit(LAY-user-back-submit)', function(data){
                              var field = data.field; //获取提交的字段

                              //提交 Ajax 成功后，静态更新表格中的数据
                              $.ajax({
                                  url: 'editApi?type=2&token=' + token, //实际使用请改成服务端真实接口
                                  type: 'post',
                                  data: field,
                                  success: function (res) {
                                      if (res.data.code == 1001) {
                                          table.reload('LAY-user-back-manage');
                                          layer.close(index); //关闭弹层
                                      } else {
                                          table.reload('LAY-user-back-manage');
                                          layer.close(index); //关闭弹层
                                      }
                                  }
                              });
                              table.reload('LAY-user-front-submit'); //数据刷新
                              layer.close(index); //关闭弹层
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
    $('.layui-btn.layuiadmin-btn-admin').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });
  });
  </script>
</body>
</html>

