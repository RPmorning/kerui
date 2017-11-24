<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/2/23
 * Time: 9:23
 */
namespace app\admin\controller;

use app\common\controller\Common;
use app\common\service\Member;
use think\Hook;
use think\Session;

class Passport extends Common
{
    /**
     * 显示登录界面
     *
     * @return html
     */
    public function login()
    {
        if(defined('UID')) {// 还没登录 跳转到登录页面
          return  $this->redirect('index/');
        }
        $this->assign('pageTitle','登陆系统');
        return $this->fetch();
    }
    /**
     * 处理登录
     * @param Member $member
     * @param string $username
     * @param string $password
     * @return \think\Response
     */
    public function doLogin(Member $member, $username, $password ,$verification)
    {
        $uid = $member->login($username, $password ,$verification);
        switch ($uid)
        {
            case -1 : $this->error("登录失败，用户不存在或被禁用", url('login'));
                break;
            case -2 : $this->error("登录失败，密码错误", url('login'));
                break;
            case -3 : $this->error("登录失败，验证码错误", url('login'));
                break;
            default :
                $menus = \app\common\model\Menu::where(['status'=>1])->select();
                $menus = list_to_tree(collection($menus)->toArray());
                Session::set('menus',$menus);
                Session::set('__MENU__',$menus);
                $this->success("登录成功", "index/");
//                Hook::listen("member_login", $uid); $this->success("登录成功", "index/");
        }
    }

    public function doRegister(Member $member)
    {
        $data   = $this->request->param();
        $result = $member->register($data);
        if ($result) {
            $this->success('用户注册成功');
        } else {
            $this->error($member->getError());
        }
    }

    /* 退出登录 */
    public function logout(Member $member){
        if(is_login()){
            $member->logout();
            session('[destroy]');
            $this->success('退出成功！', url('login'));
        } else {
            $this->redirect('login');
        }
    }
}