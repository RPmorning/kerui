/**
 * Created by Administrator on 2018/1/19-0019.
 */
var logUrl = "/admin/log/",
    log = {};
layui.use(['form', 'layer', 'laydate'], function () {
    var form = layui.form,
        layer = layui.layer,
        laydate = layui.laydate;

    laydate.render({
        elem: '#test'
    })

    log.search = function () {
        var s_time = $('#test').val();
        if(s_time === ''){
            layer.msg('别乱搞，请选择时间！',{time:1300},function () {
                return false;
            })
        }

        // $.ajax({
        //     type: 'POST',
        //     url: logUrl + "search",
        //     data: {"s_time":s_time},
        //     dataType: 'json',
        //     success: function (result) {
        //         if (result) {
        //             layer.msg('搜索成功！', {time: 2000}, function () {
        //                 // window.location.replace(logUrl+index.html);
        //                 present.location.reload();
        //             });
        //         }
        //     }
        // })

        window.location.replace(logUrl + "search/s_time/"+s_time );
    }

});
