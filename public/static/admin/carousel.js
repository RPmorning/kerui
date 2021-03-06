/**
 * Created by Administrator on 2017/11/22.
 */

layui.use(['carousel', 'form','layer'], function(){
    var carousel = layui.carousel
        ,layer = layui.layer
        ,form = layui.form;

    //图片轮播
    carousel.render({
        elem: '#test10'
        ,width: '880px'
        ,height: '519px'
        ,interval:3000  //时间间隔
    });


    var $ = layui.$, active = {
        set: function(othis){
            var THIS = 'layui-bg-normal'
                ,key = othis.data('key')
                ,options = {};

            othis.css('background-color', '#5FB878').siblings().removeAttr('style');
            options[key] = othis.data('value');
            ins3.reload(options);
        }
    };

    //监听开关
    form.on('switch(autoplay)', function(){
        ins3.reload({
            autoplay: this.checked
        });
    });

    $('.demoSet').on('keyup', function(){
        var value = this.value
            ,options = {};
        if(!/^\d+$/.test(value)) return;

        options[this.name] = value;
        ins3.reload(options);
    });

    //其它示例
    $('.demoTest .layui-btn').on('click', function(){
        var othis = $(this), type = othis.data('type');
        active[type] ? active[type].call(this, othis) : '';
    });
});