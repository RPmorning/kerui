<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:72:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\member\index.html";i:1510024745;s:71:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\public\base.html";i:1510024745;s:73:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\public\header.html";i:1510124867;s:71:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\public\menu.html";i:1510024745;s:73:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\member\create.html";i:1510024745;s:73:"D:\phpStudy\WWW\phpRP\renpeng\public/../app/admin\view\public\footer.html";i:1510024745;}*/ ?>
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
                    
                    
<article class="main-user">
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li class="layui-this">成员列表</li>
            <li>添加成员</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <table class="layui-table">
                    <tr>
                        <td>用户编号</td>
                        <td>用户账号</td>
                        <td>真实姓名</td>
                        <td>最后登录IP</td>
                        <td>最后登录时间</td>
                        <td>用户状态</td>
                        <td>用户操作</td>
                    </tr>
                    <?php if(is_array($members) || $members instanceof \think\Collection || $members instanceof \think\Paginator): $i = 0; $__LIST__ = $members;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$member): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo $member['id']; ?></td>
                        <td><?php echo $member['username']; ?></td>
                        <td><?php echo $member['realname']; ?></td>
                        <td><?php echo $member['last_login_ip']; ?></td>
                        <td><?php echo $member['last_login_time']; ?></td>
                        <td class="layui-form">
                            <input type="checkbox" lay-skin="switch" lay-filter="status" lay-text="ON|OFF" data-id="<?php echo $member['id']; ?>"  value="1" <?php if($member['status'] == '1'): ?> checked<?php endif; ?>>
                        </td>
                        <td class="textalign">
                            <a href="javascript:member.edit('<?php echo $member['id']; ?>');" class="layui-btn layui-btn-small btn-success">
                                编辑
                            </a>
                            <a href="javascript:member.delete('<?php echo $member['id']; ?>');"  class="layui-btn layui-btn-small btn-danger">
                                删除
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
                <div class="fr mt20">
                    总记录数：<?php echo $members->total(); ?> <?php echo $members->render(); ?>
                </div>
            </div>
            <div class="layui-tab-item">
                <form class="layui-form mt20">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" name="username" class="layui-input" lay-verify="required|username" placeholder="请输入用户名">
        </div>
        <div class="layui-form-mid layui-word-aux">
            <cite class="fcRed mr5">*</cite>
            <span class="mark-name">登录使用，用户名长度4-30</span>
         </div>
    </div>
    <div class="layui-form-item">
         <label class="layui-form-label">真实姓名</label>
         <div class="layui-input-inline">
             <input type="text" name="realname" class="layui-input" lay-verify="required|realname" placeholder="请输入真实姓名">
         </div>
         <div class="layui-form-mid layui-word-aux">
             <cite class="fcRed mr5">*</cite>
             <span class="mark-name">英文名也可以</span>
         </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密　 码</label>
        <div class="layui-input-inline">
            <input type="password" name="password" class="layui-input" lay-verify="required|password" placeholder="请输入密码">
        </div>
        <div class="layui-form-mid layui-word-aux">
            <cite class="fcRed mr5">*</cite>
            <span class="mark-name">密码长度4-30</span>
        </div>
    </div>
    <div class="layui-form-item">
         <label class="layui-form-label">性  别</label>
         <div class="layui-input-inline">
             <select name="sex" lay-filter="sex">
                 <option value="0">男</option>
                 <option value="1">女</option>
             </select>
         </div>
    </div>
    <div class="layui-form-item">
         <label class="layui-form-label">职  务</label>
         <div class="layui-input-inline">
             <input type="text" name="position" class="layui-input" placeholder="请输入职务">
         </div>
    </div>
    <div class="layui-form-item">
         <label class="layui-form-label">描  述</label>
         <div class="layui-input-inline">
             <input type="text" name="desc" class="layui-input" placeholder="请输入描述">
         </div>
    </div>
    <div class="layui-form-item">
         <label class="layui-form-label">办公电话</label>
         <div class="layui-input-inline">
             <input type="text" name="office_phone" class="layui-input" placeholder="请输入办公电话">
         </div>
    </div>
    <div class="layui-form-item">
         <label class="layui-form-label">移动电话</label>
         <div class="layui-input-inline">
             <input type="text" name="mobile_phone" class="layui-input" placeholder="请输入移动电话">
         </div>
    </div>
    <div class="layui-form-item">
         <label class="layui-form-label">QQ</label>
         <div class="layui-input-inline">
             <input type="text" name="qq" class="layui-input" placeholder="请输入QQ号">
         </div>
    </div>
    <div class="layui-input-block">
         <a class="layui-btn save-btn" lay-filter="create" lay-submit>保存</a>
         <input type="reset" class="layui-btn layui-btn-primary goback" value="取消">
    </div>
</form>
            </div>
        </div>
    </div>
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
