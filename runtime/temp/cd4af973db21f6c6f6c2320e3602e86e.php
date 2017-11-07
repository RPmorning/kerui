<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\category\edit.html";i:1510024745;}*/ ?>
<form class="layui-form mt20">
    <div class="layui-form-item">
        <label class="layui-form-label">上级</label>
        <div class="layui-input-inline">
            <select name="pid" lay-filter="pid">
                <option value="0|0">作为一级栏目</option>
                <?php if(is_array($categorys) || $categorys instanceof \think\Collection || $categorys instanceof \think\Paginator): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $node['id']; ?>|<?php echo $node['level']; ?>"<?php if($node['id'] == $category['pid']): ?> selected<?php endif; ?>><?php echo str_repeat("&nbsp;&nbsp;",$node['level']).dec2roman($node['level']); ?>—<?php echo $node['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
        <div class="layui-form-mid layui-word-aux"><cite class="fcRed mr5">*</cite></div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">栏目类型</label>
        <div class="layui-input-inline">
            <select name="type" lay-filter="editType">
                <?php if(is_array(\think\Config::get('category.type')) || \think\Config::get('category.type') instanceof \think\Collection || \think\Config::get('category.type') instanceof \think\Paginator): $i = 0; $__LIST__ = \think\Config::get('category.type');if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $key; ?>"<?php if($category['type'] == $key): ?> selected<?php endif; ?>><?php echo $type; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item" id="edit-model">
        <label class="layui-form-label">所属模型</label>
        <div class="layui-input-inline">
            <select name="model_id" lay-filter="model">
                <?php if(is_array(\think\Config::get('category.model')) || \think\Config::get('category.model') instanceof \think\Collection || \think\Config::get('category.model') instanceof \think\Paginator): $i = 0; $__LIST__ = \think\Config::get('category.model');if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$model): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $key; ?>"<?php if($category['model_id'] == $key): ?> selected<?php endif; ?>><?php echo $model; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">栏目标题</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" lay-verify="required" name="name" value="<?php echo $category['name']; ?>">
        </div>
    </div>

    <div class="layui-form-item hidden" id="edit-url">
        <label class="layui-form-label">链接地址</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="url" placeholder="请输入外部链接地址" value="<?php echo $category['url']; ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">栏目排序</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="sort"   placeholder="20"  value="<?php echo $category['sort']; ?>">
        </div>
    </div>
    <div class="layui-input-block">
        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
        <a class="layui-btn save-btn layui-btn-normal" lay-filter="save" lay-submit>保存</a>
        <input type="reset" class="layui-btn layui-btn-primary goback" value="重置">
    </div>
</form>
