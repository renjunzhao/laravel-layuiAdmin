

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layuiAdmin 网站用户</title>
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
{{--          <div class="layui-inline">--}}
{{--            <label class="layui-form-label">ID</label>--}}
{{--            <div class="layui-input-block">--}}
{{--              <input type="text" name="id" placeholder="请输入" autocomplete="off" class="layui-input">--}}
{{--            </div>--}}
{{--          </div>--}}
          <div class="layui-inline">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
              <input type="text" name="username" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
              <input type="text" name="email" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">是否锁定</label>
            <div class="layui-input-block">
              <select name="is_lock">
                <option value="0">不限</option>
                <option value="1">是</option>
                <option value="2">否</option>
              </select>
            </div>
          </div>
            <input type="hidden" name="token" id="token" value="{{$token}}">
          <div class="layui-inline">
            <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="LAY-user-front-search">
              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
          <button class="layui-btn layuiadmin-btn-useradmin" data-type="batchdel">删除</button>
{{--          <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加</button>--}}
        </div>

        <table id="LAY-user-manage" lay-filter="LAY-user-manage"></table>
        <script type="text/html" id="imgTpl">
          <img style="display: inline-block; width: 50%; height: 100%;" src="">
        </script>
        <script type="text/html" id="table-useradmin-webuser">
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

    //监听搜索
    form.on('submit(LAY-user-front-search)', function(data){
      var field = data.field;
        console.log(field)
        $.ajax({
            url: 'listApi?type=1&token='+token,
            type:'get',
            data: field,
            success :function(data){
                if (data.data.code == 1001){
                    //执行重载
                    table.reload('LAY-user-manage', {
                        where: field
                    });
                }else{
                    //执行重载
                    table.reload('LAY-user-manage', {
                        where: field
                    });
                }
            }
        });
      //执行重载
      // table.reload('LAY-user-manage', {
      //   where: field
      // });
    });

    //事件
    var active = {
      batchdel: function(){
        var checkStatus = table.checkStatus('LAY-user-manage')
        ,checkData = checkStatus.data; //得到选中的数据

        if(checkData.length === 0){
          return layer.msg('请选择数据');
        }

          layer.confirm('确定删除吗？', function() {
              console.log(checkStatus)
              //执行 Ajax 后重载
              $.ajax({
                  url: 'batchDelApi?type=1&token='+token,
                  type:'get',
                  data: {"arr": checkData},
                  success :function(data){
                      if (data.data.code == 1001){
                          table.reload('LAY-user-manage');
                          layer.msg('已删除');
                      }else{
                          table.reload('LAY-user-manage');
                          layer.msg('删除失败');
                      }
                  }
              });

          });
      }
      ,add: function(){
        layer.open({
          type: 2
          ,title: '添加用户'
          ,content: 'userEditForm?token='+token
          ,maxmin: true
          ,area: ['500px', '450px']
          ,btn: ['确定', '取消']
          ,yes: function(index, layero){
            var iframeWindow = window['layui-layer-iframe'+ index]
            ,submitID = 'LAY-user-front-submit'
            ,submit = layero.find('iframe').contents().find('#'+ submitID);

            //监听提交
            iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
              var field = data.field; //获取提交的字段

              //提交 Ajax 成功后，静态更新表格中的数据
              //$.ajax({});
              table.reload('LAY-user-front-submit'); //数据刷新
              layer.close(index); //关闭弹层
            });

            submit.trigger('click');
          }
        });
      }
    };

    layui.define(['table', 'form'], function(exports){
          var $ = layui.$
              ,table = layui.table
              ,form = layui.form;

          //用户管理
          table.render({
              elem: '#LAY-user-manage'
              ,url: 'listApi?type=1&token='+token //模拟接口
              ,cols: [[
                   {type: 'checkbox', fixed: 'left'}
                  ,{field: 'id', width: 100, title: 'ID', sort: true}
                  ,{field: 'username', title: '用户名', minWidth: 100}
                  ,{field: 'headimgurl', title: '头像', width: 100, templet: function(rec){
                          return '<img style="display: inline-block; width: 50%; height: 100%;" src='+rec.headimgurl+'>'
                      }}
                  ,{field: 'area_code', title: '区号'}
                  ,{field: 'phone', title: '手机号'}
                  ,{field: 'email', title: '邮箱'}
                  ,{field: 'id_card', title: '身份证号'}
                  ,{field: 'nationality', title: '国籍'}
                  ,{field: 'is_lock', title: '是否锁定',templet:function(rec){
                              if(rec.is_lock == 2){
                                  return "否";
                              }else if(rec.is_lock == 1){
                                  return "是";
                              }else{
                                  return rec.is_lock;
                              }
                          }}
                  ,{field: 'created_at', title: '加入时间', sort: true}
                  ,{title: '操作', width: 150, align:'center', fixed: 'right', toolbar: '#table-useradmin-webuser'}
              ]]
              ,page: true
              ,limit: 30
              ,height: 'full-220'
              ,text: '对不起，加载出现异常！'
          });

          //监听工具条
          table.on('tool(LAY-user-manage)', function(obj){
              var data = obj.data;
              if(obj.event === 'del'){
                  layer.confirm('确定删除此用户？', function(index){
                      console.log(obj)
                      $.ajax({
                          url: 'delApi?type=1&token='+token,
                          type:'post',
                          data: obj.data,
                          success :function(data){
                              if (data.data.code == 1001){
                                  table.reload('LAY-user-manage');
                                  layer.msg('已删除');
                              }else{
                                  table.reload('LAY-user-manage');
                                  layer.msg('删除失败');
                              }
                          }
                      });
                  });
              } else if(obj.event === 'edit'){
                  var tr = $(obj.tr);
                  layer.open({
                      type: 2
                      ,title: '编辑用户'
                      ,content: 'userEditForm?token='+token+'&id='+data.id
                      ,maxmin: true
                      ,area: ['500px', '450px']
                      ,btn: ['确定', '取消']
                      ,yes: function(index, layero){
                          var iframeWindow = window['layui-layer-iframe'+ index]
                              ,submitID = 'LAY-user-front-submit'
                              ,submit = layero.find('iframe').contents().find('#'+ submitID);

                          //监听提交
                          iframeWindow.layui.form.on('submit(LAY-user-front-submit)', function(data){
                              var field = data.field; //获取提交的字段

                              //提交 Ajax 成功后，静态更新表格中的数据
                              $.ajax({
                                  url: 'editApi?type=1&token=' + token, //实际使用请改成服务端真实接口
                                  type: 'post',
                                  data: field,
                                  success: function (res) {
                                      console.log(res)
                                      if (res.data.code == 1001) {
                                          table.reload('LAY-user-manage'); //数据刷新
                                          layer.close(index); //关闭弹层
                                      } else {
                                          table.reload('LAY-user-manage');  //数据刷新
                                          layer.close(index); //关闭弹层
                                      }
                                  }
                              });

                          });

                          submit.trigger('click');
                      }
                      ,success: function(layero, index){

                      }
                  });
              }
          });
          exports('useradmin', {})
      });

    $('.layui-btn.layuiadmin-btn-useradmin').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });
  });
  </script>
</body>
</html>
