<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\link\edit.html";i:1510024745;}*/ ?>
<form class="layui-form m20">
    <div class="layui-form-item">
        <label class="layui-form-label">链接标题</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" lay-verify="required" placeholder="请输入标题" name="title" value="<?php echo $link['title']; ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">链接地址</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input"  placeholder="请输入链接地址" name="url" value="<?php echo $link['url']; ?>">
        </div>
    </div>
    <div class="layui-input-block">
        <input type="hidden" name="id" value="<?php echo $link['id']; ?>">
        <a class="layui-btn save-btn layui-btn-normal" lay-filter="save" lay-submit>保存</a>
        <input type="reset" class="layui-btn layui-btn-primary goback" value="重置">
    </div>
</form>
