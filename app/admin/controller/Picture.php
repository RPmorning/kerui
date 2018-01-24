<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2018/1/24-0024
 * Time: 15:11
 */
namespace app\admin\controller;

class Picture extends Base
{
    public function index(){
        return $this->fetch();
    }
}