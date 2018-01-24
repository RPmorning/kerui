<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2018/1/24-0024
 * Time: 9:43
 */
namespace app\admin\controller;

use app\common\service\Member as MemberService;

class Customer extends Base
{
    protected $member;

    public function __construct(MemberService $member)
    {
        parent::__construct();
        $this->member = $member;
    }

    public function index(){

        $this->pageTitle = "个人介绍";
        $this->assign('pageTitle',$this->pageTitle);
        $data = $this->member->getUserInfo();
        if($data){
            $this->assign('userInfo',$data);
        }
        $request = request();
        $this->assign('url',$request->domain().'/upload/');
        return $this->fetch();
    }
}