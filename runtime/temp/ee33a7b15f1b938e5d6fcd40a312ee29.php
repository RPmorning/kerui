<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\member\edit.html";i:1510024745;}*/ ?>
<form class="layui-form mt20">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" name="username" class="layui-input" lay-verify="required|username" value="<?php echo $member['username']; ?>">
        </div>
        <div class="layui-form-mid layui-word-aux">
            <cite class="fcRed mr5">*</cite>
            <span class="mark-name">登录使用，用户名长度4-30</span>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">真实姓名</label>
        <div class="layui-input-inline">
            <input type="text" name="realname" class="layui-input" lay-verify="required|realname" value="<?php echo $member['realname']; ?>">
        </div>
        <div class="layui-form-mid layui-word-aux">
            <cite class="fcRed mr5">*</cite>
            <span class="mark-name">英文名也可以</span>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">性  别</label>
        <div class="layui-input-inline">
            <select name="sex" lay-filter="sex">
                <option value="0" <?php if($member['sex'] == '0'): ?> selected<?php endif; ?>>男</option>
                <option value="1" <?php if($member['sex'] == '1'): ?> selected<?php endif; ?>>女</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">职  务</label>
        <div class="layui-input-inline">
            <input type="text" name="position" class="layui-input" value="<?php echo $member['position']; ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">描  述</label>
        <div class="layui-input-inline">
            <input type="text" name="desc" class="layui-input" value="<?php echo $member['desc']; ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">办公电话</label>
        <div class="layui-input-inline">
            <input type="text" name="office_phone" class="layui-input" value="<?php echo $member['office_phone']; ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">移动电话</label>
        <div class="layui-input-inline">
            <input type="text" name="mobile_phone" class="layui-input" value="<?php echo $member['mobile_phone']; ?>">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">QQ</label>
        <div class="layui-input-inline">
            <input type="text" name="qq" class="layui-input" value="<?php echo $member['qq']; ?>">
        </div>
    </div>
    <div class="layui-input-block">
        <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
        <a class="layui-btn save-btn" lay-filter="update" lay-submit>保存</a>
        <input type="reset" class="layui-btn layui-btn-primary goback" value="重置">
    </div>
</form>