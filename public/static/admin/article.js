var articleUrl = "/admin/article/",
    article = {},
    loadIndex,
    editIndex,
    layerDom,cover = null,
    uploadSrc = $("#coverImag");
layui.use(['form','element','upload'], function() {
    var form = layui.form,
        upload = layui.upload,
        element = layui.element;

    // 创建一个上传实例
    uploadCover();

    // 创建一个编辑器
    UE.getEditor("container", {
        authHeight: false
    });

    // 验证规则
    form.verify({
        letter:function(value){
            if(!/^[A-Za-z]+.+$/.test(value)){
                return '只能是字母或连接点'
            }
        },
        content: function(value){
            layedit.sync(editIndex);
        }
    });

    // Listen In From
    form.on('switch(status)', function(data){
        var param = {
            id: $(this).attr("data-id"),
            status: (data.elem.checked) ? data.value : 0
        }
        $.post(articleUrl + "status", param,  function (result) {
            layer.msg(result.msg, {time:1500}, function () {
                window.location.replace(result.url);
            });
        });

    });

    form.on('select(categoryFilter)', function(data){
        window.location.replace(articleUrl + "index/cid/" + data.value);
        return false;
    });

    form.on('submit(save)', function(data){
        data.field.cover = cover ? cover : uploadSrc.attr("data-src");
        $.post(articleUrl + "save", data.field,  function (result) {
            //console.log(result);
            layer.msg(result.msg, {time:2000}, function () {
                if(result.code) window.location.replace(result.url);
            });
        });
        return false;
    });

    article.edit = function (id) {
        // layer.open({
        //     type: 2,
        //     title: '编辑文章',
        //     area: ['800px', '850px'],
        //     shadeClose: true,
        //     maxmin: true,
        //     content: articleUrl + 'edit/id/'+id
        // });

        $.getJSON(articleUrl + "edit/id/" + id, function (result) {
            if(result.code) {
                UE.delEditor('edit-container-'+id);
                var edit = $(".layui-tab-title").children("li:eq(2)");
                if(edit){
                    layid = edit.attr("lay-id");
                    element.tabDelete('article', layid);
                };
                element.tabAdd('article',{
                    title: '编辑新闻',
                    content: result.data,
                    id: id
                });
                element.tabChange('article', id);
                // reload form
                uploadCover();
                // uploadSrc = $("#edit-cover-src");
                form.render();
            }else{
                layer.msg(result.msg, {time:2000});
            }
        });
    };

    article.delete = function (id) {
        var index = layer.confirm('确定删除？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.getJSON(articleUrl + "delete/id/" + id, function (result) {
                layer.msg(result.msg, {time:2000}, function () {
                    if(result.code) window.location.replace(result.url);
                });
            });
        }, function(){
            layer.close(index);
        });
    };

    //普通图片上传


    // 定义一个封面上传控件
    function uploadCover() {
        upload.render({
            elem: '#test1'
            ,url: articleUrl + 'cover'
            ,method: 'post' //上传接口的http类型
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#coverImag').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){

                // 如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败!');
                }else {
                    $("#covers").val(res.path);
                    return layer.msg('上传成功！');
                }
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#coverText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });

        // upload.render({
        //     elem: '#cover-src'
        //     ,url: articleUrl + "cover" //必填项
        //     ,title: '请上文章封面图(3:2)'
        //     ,method: 'post',  //可选项。HTTP类型，默认post
        //     before: function(input){
        //         //返回的参数item，即为当前的input DOM对象
        //         loadIndex = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        //         console.log('文件上传中');
        //     },
        //     success: function(result){
        //         layer.close(loadIndex);
        //         if(result.code){
        //             layer.msg("上传成功", {time:2000}, function () {
        //                 cover = result.path;
        //                 uploadSrc.attr("src", uploadSrc.attr("data-path") + "/" + cover);
        //                 uploadSrc.fadeIn();
        //             });
        //
        //         }else{
        //             layer.msg("上次失败" + result.msg,  {time:2000});
        //         }
        //     }
        // });

    }
    article.share = function (id) {
        var list = '';
        list = id;
        layer.confirm('确定发表', {icon: 3, title: '提示'}, function (index) {
            $.post(articleUrl + 'share/id/' + list, function (result) {
                layer.msg(result.msg, {time: 2000}, function () {
                    window.location.reload();
                });
            });
        });
    }
});