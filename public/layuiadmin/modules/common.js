/**

 @Name：layuiAdmin 公共业务
 @Author：贤心
 @Site：http://www.layui.com/admin/
 @License：LPPL

 */

layui.define(function(exports){
    var $ = layui.$
        ,layer = layui.layer
        ,laytpl = layui.laytpl
        ,setter = layui.setter
        ,view = layui.view
        ,admin = layui.admin

    admin.events.logout = function(){
        $.ajax({
            url: 'auth/logout'
            , type: 'post'
            , data: {}
            , success: function (data) {
                if (data.data.code == 1001) {
                    layer.msg(data.msg, {
                        offset: '15px'
                        , icon: 1
                        , time: 1000
                    }, function () {
                        location.href = '/';
                    });
                } else {
                    layer.msg(data.msg, {
                        offset: '15px'
                        , icon: 1
                        , time: 1000
                    }, function () {
                        location.href = '/';
                    });
                }
            }
        });


    }
    //对外暴露的接口
    exports('common', {});
});
