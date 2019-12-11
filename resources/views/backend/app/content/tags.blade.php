
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layuiAdmin 内容系统-分类管理</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
  <link rel="stylesheet" href="{{url('src/layuiadmin/style/admin.css')}}" media="all">
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header layuiadmin-card-header-auto">
        <button class="layui-btn layuiadmin-btn-tags" data-type="add">添加</button>
      </div>
      <div class="layui-card-body">
        <table id="LAY-app-content-tags" lay-filter="LAY-app-content-tags"></table>
          <input type="hidden" name="token" value="{{$token}}" id="token">
        <script type="text/html" id="layuiadmin-app-cont-tagsbar">
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
  }).use(['index', 'contlist', 'table'], function(){

    var table = layui.table;

    var $ = layui.$, active = {
      add: function(){
        layer.open({
          type: 2
          ,title: '添加分类'
          ,content: '/category/create?token='+$('#token').val()
          ,area: ['450px', '200px']
          ,btn: ['确定', '取消']
          ,yes: function(index, layero){
                var iframeWindow = window['layui-layer-iframe'+ index]
                    ,submit = layero.find('iframe').contents().find("#layuiadmin-app-form-submit");

                //监听提交
                iframeWindow.layui.form.on('submit(layuiadmin-app-form-submit)', function(data){
                    var field = data.field; //获取提交的字段
                    console.log(field)
                    //提交 Ajax 成功后，静态更新表格中的数据
                    $.ajax({
                        url: '/category?token='+field.token, //实际使用请改成服务端真实接口
                        type:'post',
                        data: field,
                        success: function(res){
                            table.reload('LAY-app-content-tags');
                            layer.close(index); //关闭弹层
                        }
                    });
                });

                submit.trigger('click');
          }
        });
      }
    }


      layui.define(['table', 'form'], function(exports) {
          var $ = layui.$
              , table = layui.table
              , form = layui.form;
            var token = $('#token').val()
          //分类管理
          table.render({
              elem: '#LAY-app-content-tags'
              ,url: 'category?type=1&token='+token //模拟接口
              ,cols: [[
                  {type: 'numbers', fixed: 'left'}
                  ,{field: 'id', width: 100, title: 'ID', sort: true}
                  ,{field: 'name', title: '分类名', minWidth: 100}
                  ,{field: 'sort', title: '排序', minWidth: 100}
                  ,{field: 'is_show', title: '是否显示', minWidth: 100,templet: function(res){
                          if (res.is_show == 1){
                              return "<button class=\"layui-btn layui-btn-xs\">是</button>";
                          }else{
                              return " <button class=\"layui-btn layui-btn-primary layui-btn-xs\">否</button>";
                          }
                      }}
                  ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#layuiadmin-app-cont-tagsbar'}
              ]]
              ,page: true
              ,limit: 10
              ,limits: [10, 15, 20, 25, 30]
              ,text: '对不起，加载出现异常！'
          });
          //监听工具条
          table.on('tool(LAY-app-content-tags)', function(obj){
              var data = obj.data;

              if(obj.event === 'del'){
                  layer.confirm('确定删除此分类？', function(index){
                      $.ajax({
                          url: '/category/'+ data.id +'?token='+$('#token').val(),
                          type:'delete',
                          success :function(data){
                              table.reload('LAY-app-content-tags');
                              layer.msg('已删除');
                              layer.close(index);
                          }
                      });
                  });
              } else if(obj.event === 'edit'){
                  var tr = $(obj.tr);
                  var token = $('#token').val()
                  layer.open({
                      type: 2
                      ,title: '编辑分类'
                      ,content: '/category/'+ data.id + '?token='+token
                      ,area: ['450px', '200px']
                      ,btn: ['确定', '取消']
                      ,yes: function(index, layero){
                          var iframeWindow = window['layui-layer-iframe'+ index]
                              ,submit = layero.find('iframe').contents().find("#layuiadmin-app-form-edit");

                          //监听提交
                          iframeWindow.layui.form.on('submit(layuiadmin-app-form-edit)', function(data){
                              var field = data.field; //获取提交的字段
                              console.log(field)
                              //提交 Ajax 成功后，静态更新表格中的数据
                              $.ajax({
                                  url: '/category/'+ field.id +'?token='+token, //实际使用请改成服务端真实接口
                                  type:'put',
                                  data: field,
                                  success: function(res){
                                      table.reload('LAY-app-content-tags');
                                      layer.close(index); //关闭弹层
                                  }
                              });
                          });

                          submit.trigger('click');
                      }
                      ,success: function(layero, index){
                          //给iframe元素赋值
                          var othis = layero.find('iframe').contents().find("#layuiadmin-app-form-tags").click();
                          othis.find('input[name="tags"]').val(data.tags);
                      }
                  });
              }
          });
      });



          $('.layui-btn.layuiadmin-btn-tags').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });
  });
  </script>
</body>
</html>
