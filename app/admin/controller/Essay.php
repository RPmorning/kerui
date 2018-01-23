<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2018/1/23-0023
 * Time: 9:31
 */
namespace app\admin\controller;

use app\common\model\Article;

class Essay extends Base
{
    public function index(){
        $this->pageTitle = "文章中心";
        $this->assign('pageTitle',$this->pageTitle);
        $data = Article::where('tag',1)->paginate('12');
        if($data){
            $this->assign('essay',$data);
        }
        return $this->fetch();
    }
}