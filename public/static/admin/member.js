var memberUrl = "/admin/member/",
    member = {};
layui.use(['form'], function(){
    var form = layui.form(),
        layer = layui.layer;

    form.on('switch(status)', function(data){
        var param = {
            id: $(this).attr("data-id"),
            status: (data.elem.checked) ? data.value : 0
        }
        $.getJSON(memberUrl + "status", param, function (result) {
            layer.msg(result.msg, {time:2000}, function () {
                window.location.reload();
            });
        });
    });

    form.on('submit(create)', function(data){
        $.post(memberUrl + "save", data.field,  function (result) {
            layer.msg(result.msg, {time:2000}, function () {
                if(result.code) window.location.replace(result.url);
            });
        });
        return false;
    });

    form.on('submit(update)', function(data){
        $.post(memberUrl + "update", data.field,  function (result) {
            layer.msg(result.msg, {time:2000}, function () {
                if(result.code) window.location.replace(result.url);
            });
        });
        return false;
    })

    // member Option
    member.edit = function (id) {
        $.getJSON(memberUrl + "edit/id/" + id, function (result) {
            layer.open({
                type: 1,
                title: result.msg,
                area: ['700px', '600px'],
                shadeClose: true,
                content: result.data
            });
            // reload form
            form.render();
        });
    };

    member.delete = function (id) {
        var index = layer.confirm('确定删除？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.getJSON(memberUrl + "delete/id/" + id, function (result) {
                layer.msg(result.msg, {time:2000}, function () {
                    if(result.code) window.location.replace(result.url);
                });
            });
        }, function(){
            layer.close(index);
        });
    }
});



