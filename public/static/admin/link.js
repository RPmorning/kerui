var linkUrl = "/admin/link/",
    link = {},
    editIndex,
    layerDom,cover = null,
    uploadLinkSrc = $("#cover-src");
layui.use(['form','layedit'], function() {
    var form = layui.form(),
        layedit = layui.layedit;


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
        $.post(linkUrl + "status", param,  function (result) {
            layer.msg(result.msg, {time:1500}, function () {
                window.location.replace(result.url);
            });
        });

    });

    form.on('select(categoryFilter)', function(data){
        window.location.replace(linkUrl + "index/cid/" + data.value);
        return false;
    });

    form.on('submit(save)', function(data){
        data.field.cover = cover ? cover : uploadLinkSrc.attr("data-src");
        $.post(linkUrl + "save", data.field,  function (result) {
            layer.msg(result.msg, {time:1500}, function () {
                window.parent.location.reload();
            });
        });
        return false;
    });

    link.edit = function (id) {
        $.getJSON(linkUrl + "edit/id/" + id, function (result) {
            layer.open({
                type: 1,
                title: result.msg,
                area: ['600px', '300px'],
                shadeClose: true,
                content: result.data
            });
            // reload form
            form.render();
        });
    };

    link.delete = function (id) {
        var index = layer.confirm('确定删除？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.getJSON(linkUrl + "delete/id/" + id, function (result) {
                layer.msg(result.msg, {time:1500}, function () {
                    if(result.code) window.location.replace(result.url);
                });
            });
        }, function(){
            layer.close(index);
        });
    };

});