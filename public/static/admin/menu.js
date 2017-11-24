var menuUrl = "/admin/menu/",
    menu = {},
    level = 1,
    iconIndex,
    layerDom = document.getElementById("tab-create");
layui.use(['form'], function() {
    var form = layui.form;

    $("#menu-table").treetable({
        expandable : true
    });

    // 验证规则
    form.verify({
        letter:function(value){
            if(!/^[A-Za-z]+.+$/.test(value)){
                return '只能是字母或连接点'
            }
        }
    });

    // Listen In From
    form.on('switch(status)', function(data){
        var param = {
            id: $(this).attr("data-id"),
            status: (data.elem.checked) ? data.value : 0
        }
        $.getJSON(menuUrl + "status", param);
    });

    form.on('submit(save)', function(data){
        var mix = (data.field.pid).split("|");
        data.field.pid = mix[0];
        data.field.level = mix[1];
        data.field.param = (data.field.param === '例如：id=4&p=1')? '': data.field.param;
        $.post(menuUrl + "save", data.field,  function (result) {
            layer.msg(result.msg, {time:2000}, function () {
               if(result.code) window.location.replace(result.url);
            });
        });
        return false;
    });


    menu.create = function (id) {

        $.getJSON(menuUrl + "create/id/" + id, function (result) {
            layer.open({
                type: 1,
                title: result.msg,
                area: ['600px', '600px'],
                shadeClose: true,
                content: result.data,
                success: function(layero, index){
                    layerDom = layero;
                }
            });
            // reload form
            form.render();
        });
    };
    menu.edit = function (id) {
        $.getJSON(menuUrl + "edit/id/" + id, function (result) {
            layer.open({
                type: 1,
                title: result.msg,
                area: ['600px', '600px'],
                shadeClose: true,
                content: result.data,
                success: function(layero, index){
                    layerDom = layero;
                }
            });
            // reload form
            form.render();
        });
    };

    menu.delete = function (id) {
        var index = layer.confirm('确定删除？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.getJSON(menuUrl + "delete/id/" + id, function (result) {
                layer.msg(result.msg, {time:2000}, function () {
                    if(result.code) window.location.replace(result.url);
                });
            });
        }, function(){
            layer.close(index);
        });
    };

    menu.sort = function () {
        var trs = $(".menu-tr"),
            param = [];
        $.each(trs, function (k, v) {
           var sort = $(this).find(".menu-sort").val();
           if(sort != 0){
               param.push({
                   id: $(this).attr("data-tt-id"),
                   sort: sort
               })
           }
        });
        $.post(menuUrl + "sort", {param:param}, function (result) {
            layer.msg(result.msg, {time:2000}, function () {
                if(result.code) window.location.replace(result.url);
            });
        });
    };

    menu.icon = function (id) {
        $.getJSON(menuUrl + "icon", function (result) {
            layer.open({
                type: 1,
                title: result.msg,
                area: ['650px', '600px'],
                shadeClose: true,
                content: result.data,
                success: function(layero, index){
                    iconIndex = index;
                }
            });
            // reload form
            form.render();
        });
    };

    menu.build = function (id) {
        $.getJSON(menuUrl + "build/id/" + id, function (result) {
            layer.msg(result.msg, {time:2000}, function () {
                // if(result.code) window.location.replace(result.url);
            });
        });
    };
});