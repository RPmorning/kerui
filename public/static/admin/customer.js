/**
 * Created by Administrator on 2018/1/24-0024.
 */
var customerUrl = "/admin/member/",
    customer = {};
layui.use(['form','upload'], function(){
    var form = layui.form,
        layer = layui.layer,
        upload = layui.upload;


    var uploadInst = upload.render({
        elem: '#test1' //绑定元素
        ,url: '/admin/article/cover' //上传接口
        ,done: function(res){
            //上传完毕回调
            // 如果上传失败
            if(res.code > 0){
                return layer.msg('上传失败!');
            }else {
                $("#head_url").val(res.path);
                var param = {
                    head_url: res.path
                }
                $.post(customerUrl + "updateHeadUrl", param,  function (result) {
                    layer.msg(result.msg, {time:1500}, function () {
                        window.location.replace(result.url);
                    });
                });
            }
        }
        ,error: function(){
            //请求异常回调
            //演示失败状态，并实现重传
            var demoText = $('#headText');
            demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
            demoText.find('.demo-reload').on('click', function(){
                uploadInst.upload();
            });
        }
    });

});