<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/5/11
 * Time: 20:14
 */

namespace app\admin\controller;

use app\common\controller\Common;
use app\common\service\Menu;

class Base extends Common
{
    public function _initialize()
    {
        parent::_initialize();

        // 获取当前用户ID
        if(defined('UID')) return ;
        define('UID',is_login());
        if( !UID ){// 还没登录 跳转到登录页面
            $this->redirect('passport/login');
        }
        // 是否是超级管理员
        define('IS_ROOT',   is_renpeng());
        if(!IS_ROOT && config('admin_allow_ip')){
            // 检查IP地址访问
            if(!in_array(get_client_ip(),explode(',',config('admin_allow_ip')))){
                $this->error('403:禁止访问');
            }
        }
        $menus = session('menus');
        $this->assign('menus', $menus);
        $this->assign('__MENU__', $menus);

    }

}