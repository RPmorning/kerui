<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/28
 * Time: 8:42
 */
namespace app\api\controller;
use app\common\model\Page as PageModel;

class Page{
    //获取全部关于我们
    /*public function index(){
        $page = SubjectModel::all();
        if($page){
            return jsonp($page)->contentType("text/plain");
        }else{
            abort(404,'无专题');
        }
    }*/
    //获取公司简介
    public function read($id){
        $page = PageModel::get($id);
        if($page){
            return jsonp($page)->contentType("text/plain");
        }else{
            abort(404,'无此专题');
        }
    }
}