<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\page\edit.html";i:1510024745;}*/ ?>
<form class="layui-form m20">
     <div class="layui-form-item" id="page-category">
         <label class="layui-form-label">栏目分类</label>
         <div class="layui-input-inline">
             <select name="category_id" lay-filter="categoryId">
                 <?php if(is_array($categorys) || $categorys instanceof \think\Collection || $categorys instanceof \think\Paginator): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;if(isset($category['leaf'])): ?>
                 <option value="<?php echo $category['id']; ?>" disabled><?php echo str_repeat("&nbsp;&nbsp;",$category['level']).dec2roman($category['level']); ?>—<?php echo $category['name']; ?></option>
                 <?php else: ?>
                 <option value="<?php echo $category['id']; ?>"><?php echo str_repeat("&nbsp;&nbsp;",$category['level']).dec2roman($category['level']); ?>—<?php echo $category['name']; ?></option>
                 <?php endif; endforeach; endif; else: echo "" ;endif; ?>
             </select>
         </div>
     </div>
    <div class="layui-form-item">
        <label class="layui-form-label">专题标题</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" lay-verify="required" placeholder="请输入标题" name="title" value="<?php echo $page['title']; ?>">
        </div>
    </div>

    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">专题内容</label>
        <div class="layui-input-block">
            <!-- 加载编辑器的容器 -->
            <script id="edit-container-<?php echo $page['id']; ?>" name="content" type="text/plain"><?php echo $page['content']; ?></script>
        </div>
    </div>


    <div class="layui-input-block">
        <input type="hidden" name="id" value="<?php echo $page['id']; ?>">
        <a class="layui-btn save-btn layui-btn-normal" lay-filter="save" lay-submit>保存</a>
        <input type="reset" class="layui-btn layui-btn-primary goback" value="重置">
    </div>
</form>
<script>
    UE.getEditor("edit-container-<?php echo $page['id']; ?>", {
        authHeight: false
    });
</script>