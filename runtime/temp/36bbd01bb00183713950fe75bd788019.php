<?php if (!defined('THINK_PATH')) exit(); /*a:7:{s:70:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\link\index.html";i:1510024745;s:71:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\public\base.html";i:1510024745;s:73:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\public\header.html";i:1510124867;s:71:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\public\menu.html";i:1510024745;s:69:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\link\list.html";i:1510211882;s:71:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\link\create.html";i:1510024745;s:73:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\public\footer.html";i:1510024745;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo $pageTitle; ?>|<?php echo $siteOption['site_name']; ?></title>
    <link rel="shortcut icon" href="" />
    <?php $controller = strtolower(\think\Request::instance()->controller()); $action = strtolower(\think\Request::instance()->action()); ?>
    <link rel="stylesheet" type="text/css" href="__LIB__/layui/css/layui.css" /><link rel="stylesheet" type="text/css" href="__COMMON__/reset.css" /><link rel="stylesheet" type="text/css" href="__ADMIN__/common.css" />
    
    <link href="__ADMIN__/<?php echo $controller; ?>.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- Page Start -->
    <div id="kr-page">
        <?php if($controller == 'passport'): else: ?>
        <!-- Page Header Start -->
        <div id="kr-header" class="pf w clearfix">
    <a class="logo show f20 tc fl" href="<?php echo url('index'); ?>">RENPENG.ADMIN</a>
    <div class="header-nav clearfix">
        <div class="nav-menu fl">
            <a class="layui-nav-item" href="<?php echo url('/admin/index'); ?>" target="_self">
                站点首页
            </a>

        </div>
        <div class="nav-toolbar fr">
            <ul class="layui-nav">
                <li class="layui-nav-item">
                    <a href="javascript:;"><?php echo \think\Session::get('user_auth.username'); ?></a>
                    <dl class="layui-nav-child"> <!-- 二级菜单 -->
                        <dd><a href="javascript:common.updatePassword();">修改密码</a></dd>
                        <dd><a href="javascript:common.logout();">退出系统</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
</div>


        <!-- Page Header End  -->
        <!-- Page Body Start -->
        
        <div id="kr-body" class="clearfix">
            <!-- Page Aside Start -->
            <div id="kr-aside" class="pf">
                <!-- Aside Menu Start  -->
                <div class="aside-menu">
    <!--<div id="aside-sidebar" class="cursor tc"><i class="iconfont icon-sidebar"></i></div>-->
    <ul class="layui-nav layui-nav-tree" lay-filter="test">

        <?php if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "no data" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
        <li class="layui-nav-item layui-nav-itemed">
            <?php if(isset($menu['child'])): ?>
            <a href="javascript:;"><?php echo $menu['name']; ?></a>
            <dl class="layui-nav-child">
                <?php if(is_array($menu['child']) || $menu['child'] instanceof \think\Collection || $menu['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $menu['child'];if( count($__LIST__)==0 ) : echo "no data" ;else: foreach($__LIST__ as $key=>$submenu): $mod = ($i % 2 );++$i;?>
                <dd class="<?php echo (isset($submenu['class']) && ($submenu['class'] !== '')?$submenu['class']:''); ?>"><a href="<?php echo url($submenu['url']); ?>"><i class="iconfont f16 mr5 <?php echo $submenu['icon']; ?>"></i><?php echo $submenu['name']; ?></a></dd>                    <?php endforeach; endif; else: echo "no data" ;endif; ?>
            </dl>
            <?php else: ?>
            <a href="<?php echo url($menu['url']); ?>"><i class="iconfont f16 mr5 <?php echo $submenu['icon']; ?>"></i><?php echo $menu['name']; ?></a>
            <?php endif; ?>
        </li>
        <?php endforeach; endif; else: echo "no data" ;endif; ?>

    </ul>
</div>

                <!-- Aside Menu End  -->
            </div>
            <!-- Page Aside End -->
            <!-- Page Main Start  -->
            <div id="kr-main" class="pr">
                <!-- Main Blockquote Start  -->
                <div id="kr-blockquote" class="clearfix">
                    <div class="blockquote-breadcrumb fl">
                        <span class="layui-breadcrumb">
                            <a class="line pl5"><cite>您当前操作</cite></a>
                            <a><cite><?php echo $pageTitle; ?></cite></a>
                        </span>
                    </div>
                    <div class="blockquote-menu fr">
                        
                    </div>
                </div>
                <!-- Main Blockquote End  -->
                <!-- Main container Start  -->
                <div id="kr-container" class="main-container clearfix" data-url="{__URL__}">
                    
                    
<link class="main-link">
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li class="layui-this">链接列表</li>
            <li>添加链接</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show" id="link-list">
                <table class="layui-table">
    <thead>
    <tr>
        <td>链接编号</td>
        <td>链接标题</td>
        <td>链接地址</td>
        <td>更新时间</td>
        <td>链接状态</td>
        <td>管理操作</td>
    </tr>
    </thead>
    <?php if(isset($link)): if(is_array($link) || $link instanceof \think\Collection || $link instanceof \think\Paginator): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?>
    <tr>
        <td><?php echo $link['id']; ?></td>
        <td><?php echo $link['title']; ?></td>
        <td><a href="<?php echo $link['url']; ?> " target="_blank" style="color: #009E94"><?php echo $link['url']; ?></a></td>
        <td><?php echo $link['update_time']; ?></td>
        <td class="layui-form">
            <input type="checkbox" lay-skin="switch" lay-filter="status" lay-text="ON|OFF" data-id="<?php echo $link['id']; ?>"  value="1" <?php if($link['status'] == '1'): ?> checked<?php endif; ?>>
        </td>
        <td class="textalign">
            <a href="javascript:link.edit('<?php echo $link['id']; ?>');" class="layui-btn layui-btn-small btn-success">
                编辑
            </a>
            <a href="javascript:link.delete('<?php echo $link['id']; ?>');"  class="layui-btn layui-btn-small btn-danger">
                删除
            </a>
        </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
</table>

            </div>
            <div class="layui-tab-item">
                <form class="layui-form mt20">
    <div class="layui-form-item">
        <label class="layui-form-label">链接标题</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" lay-verify="required" placeholder="请输入标题" name="title">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">链接地址</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input"  placeholder="请输入链接地址" name="url">
        </div>
    </div>
    <div class="layui-input-block">
        <a class="layui-btn save-btn layui-btn-normal" lay-filter="save" lay-submit>保存</a>
        <input type="reset" class="layui-btn layui-btn-primary goback" value="重置">
    </div>
</form>

            </div>
        </div>
    </div>
</link>

                </div>
                <!-- Main container End  -->
                <!-- Page Footer Start-->
                <div id="kr-footer" class="tc f14 lh40">
    <a href="http://www.keywaysoft.com" target="_ablank"><?php echo $siteOption['site_name']; ?></a>
     &copy; 2017-<?php echo date('Y'); ?>
</div>
                <!-- Page Footer End -->
            </div>
            <!-- Page Main End  -->
        </div>
        
        <!-- Page Body End -->
        <?php endif; ?>
    </div>
    <!-- Page End -->
    <!-- Common JS Start -->
    <script type="text/javascript" src="__LIB__/jquery/jquery.min.js"></script><script type="text/javascript" src=" __LIB__/layui/layui.js"></script><script type="text/javascript" src=" __ADMIN__/common.js"></script>
    <!-- Common JS End -->
    <!-- Page JS Start -->
    
    <script src="__ADMIN__/<?php echo $controller; ?>.js"></script>
    <!-- Page JS End -->
</body>
</html>
