<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 文章管理 iframe 框</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{url('src/layuiadmin/layui/css/layui.css')}}" media="all">
</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list"
     style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">文章标题</label>
        <div class="layui-input-inline">
            <input type="text" name="title" lay-verify="required" placeholder="请输入标题" autocomplete="off"
                   class="layui-input" value="{{isset($article) ? $article['title'] : ''}}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">发布人</label>
        <div class="layui-input-inline">
            <input type="text" name="author" lay-verify="required" placeholder="" value="{{$user->name}}"
                   autocomplete="off" class="layui-input" >
            <input type="hidden" name="author_id" value="{{$user->id}}" id="author_id">
            <input type="hidden" name="token" value="{{$token}}" id="token">
            <input type="hidden" name="id" value="{{isset($article) ? $article['id'] : ''}}" id="id">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-inline">
            <input type="text" name="sort" placeholder="数字越大越靠前" autocomplete="off"
                   class="layui-input" value="{{isset($article) ? $article['sort'] : 0}}" oninput="value=value.replace(/[^\d]/g,'')">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">浏览量</label>
        <div class="layui-input-inline">
            <input type="text" name="volume" placeholder="浏览量" autocomplete="off"
                   class="layui-input" value="{{isset($article) ? $article['volume'] : 10}}" oninput="value=value.replace(/[^\d]/g,'')">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">缩略图</label>
        <div class="layui-input-inline">
            <input type="text" name="thump_nail" placeholder="请上传图片" autocomplete="off"
                   class="layui-input" value="{{isset($article) ? $article['thump_nail'] : ''}}">
        </div>
        <button style="float: left;" type="button" class="layui-btn" id="layuiadmin-upload-useradmin">上传图片</button>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">封面图</label>
        <div class="layui-input-inline">
            <input type="text" name="thump" placeholder="请上传图片" autocomplete="off"
                   class="layui-input" value="{{isset($article) ? $article['thump'] : ''}}">
        </div>
        <button style="float: left;" type="button" class="layui-btn" id="layuiadmin-upload-useradmin1">上传图片</button>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">分类</label>
        <div class="layui-input-inline">
            <select name="category_id" lay-verify="required">
                <option value="">请选择分类</option>
                @if(isset($category))
                    @foreach($category as $v)
                        <option value="{{$v->id}}"
                                @if(isset($article) && $article['category_id'] == $v->id) selected @endif>{{$v->name}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">语言</label>
        <div class="layui-input-inline">
            <select name="language_id" lay-verify="required">
                <option value="">请选择语言</option>
                @if(isset($language))
                    @foreach($language as $v)
                        <option value="{{$v->id}}"
                                @if(isset($article) && $article['language_id'] == $v->id) selected @endif>{{$v->name}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="layui-inline">
        <label class="layui-form-label">发布时间</label>
        <div class="layui-input-inline">
            <input type="text" name="release_time" class="layui-input" id="test-laydate-normal-cn"
                   placeholder="yyyy-MM-dd" value="{{isset($article) ? $article['release_time'] : ''}}">
        </div>
    </div>
    <div class="layui-form-item" lay-filter="sex">
        <label class="layui-form-label">是否显示</label>
        <div class="layui-input-block">
            <input type="radio" name="is_show" value="1" title="是"
                   @if(isset($article) && $article['is_show'] == 1) checked @endif>
            <input type="radio" name="is_show" value="2" title="否"
                   @if(isset($article) && $article['is_show'] == 2) checked @endif>
        </div>
    </div>
    <div class="layui-form-item" lay-filter="sex">
        <label class="layui-form-label">是否审核</label>
        <div class="layui-input-block">
            <input type="radio" name="is_review" value="1" title="是"
                   @if(isset($article) && $article['is_review'] == 1) checked @endif>
            <input type="radio" name="is_review" value="2" title="否"
                   @if(isset($article) && $article['is_review'] == 2) checked @endif>
        </div>
    </div>
    <div class="layui-form-item" lay-filter="sex">
        <label class="layui-form-label">是否推荐</label>
        <div class="layui-input-block">
            <input type="radio" name="is_recommend" value="1" title="是"
                   @if(isset($article) && $article['is_recommend'] == 1) checked @endif>
            <input type="radio" name="is_recommend" value="2" title="否"
                   @if(isset($article) && $article['is_recommend'] == 2) checked @endif>
        </div>
    </div>
{{csrf_field()}}
    <div class="layui-form-item">
        <label class="layui-form-label">关键词</label>
        <div class="layui-input-inline">
            <input type="text" name="key_word" lay-verify="required" placeholder="请输入关键词" autocomplete="off"
                   class="layui-input" value="{{isset($article) ? $article['key_word'] : ''}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章摘要</label>
        <div class="layui-input-inline">
            <textarea name="summary" lay-verify="required" style="width: 400px; height: 150px;" autocomplete="off"
                      class="layui-textarea">{{isset($article) ? $article['summary'] : ''}}</textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章内容</label>
        <div class="layui-input-inline">
            <textarea name="content" lay-verify="content" style="width: 400px; height: 150px;" autocomplete="off"
                      class="layui-textarea" id="content">{{isset($article) ? $article['content'] : ''}}</textarea>
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-submit" id="layuiadmin-app-form-submit"
               value="确认添加">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit"
               value="确认编辑">
    </div>
</div>

<script src="{{url('src/layuiadmin/layui/layui.js')}}"></script>
<script>
    layui.config({
        base: '../../../layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form', 'upload', 'layedit', 'laydate'], function () {
        var $ = layui.$
            , form = layui.form
            , upload = layui.upload
            , layedit = layui.layedit
            , laydate = layui.laydate;
        laydate.render({
            elem: '#test-laydate-normal-cn'
        });
        var index = layedit.build('content', {
            height: 500
        });

        form.verify({
            content: function (value) {
                layedit.sync(index);
            },
        });
        var token = $('#token').val()
        upload.render({
            elem: '#layuiadmin-upload-useradmin'
            , url: '/upload?token=' + token
            , accept: 'images'
            , method: 'post'
            , acceptMime: 'image/*'
            , done: function (res) {
                $(this.item).prev("div").children("input").val(res.data.url)
            }
        });
        upload.render({
            elem: '#layuiadmin-upload-useradmin1'
            , url: '/upload?token=' + token
            , accept: 'images'
            , method: 'post'
            , acceptMime: 'image/*'
            , done: function (res) {
                $(this.item).prev("div").children("input").val(res.data.url)
            }
        });

        //监听提交
        form.on('submit(layuiadmin-app-form-submit)', function (data) {
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            $.ajax({
                url: '/article?token='+token, //实际使用请改成服务端真实接口
                type:'post',
                data: field,
                success: function(res){
                    if (res.data.code == 1001){
                        parent.layui.table.reload('LAY-app-content-list'); //重载表格
                        parent.layer.close(index); //再执行关闭
                    }else{
                        parent.layui.table.reload('LAY-app-content-list'); //重载表格
                        parent.layer.close(index); //再执行关闭
                    }
                }
            });



        });
    })
</script>
</body>
</html>
