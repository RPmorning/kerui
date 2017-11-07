<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:71:"D:\phpStudy\WWW\kerui-master\public/../app/admin\view\config\index.html";i:1499252466;s:70:"D:\phpStudy\WWW\kerui-master\public/../app/admin\view\public\base.html";i:1499252466;s:72:"D:\phpStudy\WWW\kerui-master\public/../app/admin\view\public\header.html";i:1510022479;s:70:"D:\phpStudy\WWW\kerui-master\public/../app/admin\view\public\menu.html";i:1499252466;s:72:"D:\phpStudy\WWW\kerui-master\public/../app/admin\view\public\footer.html";i:1499252466;}*/ ?>
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
    <a class="logo show f20 tc fl" href="<?php echo url('index'); ?>">RENPRNG.ADMIN</a>
    <div class="header-nav clearfix">
        <div class="nav-menu fl">
            <a class="layui-nav-item" href="<?php echo url('/index'); ?>" target="_blank">
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
                    
                    
<article class="main-sms">
    <fieldset class="layui-elem-field">
        <legend>网站配置</legend>
        <div class="layui-field-box">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label">网站名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="site_name" class="layui-input" value="<?php echo $siteOption['site_name']; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站关键字</label>
                    <div class="layui-input-block">
                        <input type="text" name="site_keywords" class="layui-input" value="<?php echo $siteOption['site_keywords']; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站描述</label>
                    <div class="layui-input-block">
                        <input type="text" name="site_desc" class="layui-input" value="<?php echo $siteOption['site_desc']; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">咨询电话</label>
                    <div class="layui-input-block">
                        <input type="text" name="site_phone" class="layui-input" value="<?php echo $siteOption['site_phone']; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">官方客服Q号</label>
                    <div class="layui-input-block">
                        <input type="text" name="site_QQ" class="layui-input" value="<?php echo $siteOption['site_QQ']; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站版权</label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input" name="site_copy" value="<?php echo $siteOption['site_copy']; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">登录背景图</label>
                    <div class="layui-input-inline">
                        <div class="site-demo-upload">
                            <img src="__UPLOAD__/<?php echo $siteOption['site_login_bg']; ?>" data-path="__UPLOAD__"  data-name="<?php echo $siteOption['site_login_bg']; ?>" id="site-login-bg-src">
                            <div class="site-demo-upbar mt10">
                                <input type="file" name="site_login_bg" class="layui-upload-file"  lay-ext="jpg|png|gif" id="site-login-bg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站备案信息</label>
                    <div class="layui-input-block">
                        <textarea type="text" class="layui-textarea" name="site_beian"><?php echo $siteOption['site_beian']; ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn sms" lay-submit lay-filter="update">保存</button>
                    </div>
                </div>
            </form>
        </div>
    </fieldset>
</article>

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