<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\article\edit.html";i:1510024745;}*/ ?>
<form class="layui-form m20">

    <div class="layui-form-item">
        <label class="layui-form-label">文章标题</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" lay-verify="required" placeholder="请输入标题" name="name" value="<?php echo $article['name']; ?>">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">文章摘要</label>
        <div class="layui-input-block">
            <textarea class="layui-textarea" placeholder="请输入摘要" name="desc"><?php echo $article['desc']; ?></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章来源</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" placeholder="请输入来源" name="source" value="<?php echo $article['source']; ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章作者</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" placeholder="请输入作者" name="author" value="<?php echo $article['author']; ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章封面</label>
        <div class="layui-input-block">
            <div class="cover-upload">
                <img data-path="__UPLOAD__" id="edit-cover-src" data-src="<?php echo $article->getData('cover'); ?>" <?php if(empty($article['cover']) || (($article['cover'] instanceof \think\Collection || $article['cover'] instanceof \think\Paginator ) && $article['cover']->isEmpty())): ?>class="hidden"<?php else: ?>src="<?php echo $article['cover']; ?>"<?php endif; ?>>
                <div class="site-demo-upbar mt10">
                    <input type="file" name="cover" class="layui-upload-file"  lay-ext="jpg|png|gif" id="edit-cover">
                </div>
            </div>
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">文章内容</label>
        <div class="layui-input-block">
            <!-- 加载编辑器的容器 -->
            <script id="edit-container-<?php echo $article['id']; ?>" name="content" type="text/plain"><?php echo $article['content']; ?></script>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">文章排序</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" placeholder="10" name="sort" value="<?php echo $article['sort']; ?>">
        </div>
    </div>
    <div class="layui-input-block">
        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
        <a class="layui-btn save-btn layui-btn-normal" lay-filter="save" lay-submit>保存</a>
        <input type="reset" class="layui-btn layui-btn-primary goback" value="重置">
    </div>
</form>
<script>
    UE.getEditor("edit-container-<?php echo $article['id']; ?>", {
        authHeight: false
    });
</script>