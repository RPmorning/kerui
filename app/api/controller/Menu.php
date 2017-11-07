<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/22
 * Time: 10:02
 */
namespace app\api\controller;
use app\common\model\Category as CategoryModel;

class Menu{
    //获得全部导航栏
    public function index(){
        $menu = CategoryModel::where('status',1)->field('id,name,pid,type,model_id')->select();
        if($menu){
            return jsonp($menu)->contentType("text/plain");
        }else{
            //抛出Http异常，并发送404状态码
            abort(404,'用户不存在');
        }
    }
    //获得父导航栏
    public function read($id){
        $menu = CategoryModel::where('pid',$id)->field('id,name,pid,type,model_id')->select();
        if($menu){
            return jsonp($menu)->contentType("text/plain");
        }else{
            //抛出Http异常，并发送404状态码
            abort(404,'用户不存在');
        }
    }
    //获得产品的导航栏
    /*public function readProduct(){
        $menu = CategoryModel::where('pid',3)->field('id,name,pid,type,model_id')->select();
        if($menu){
            return jsonp($menu)->contentType("text/plain");
        }else{
            //抛出Http异常，并发送404状态码
            abort(404,'用户不存在');
        }
    }*/
    //获得关于我们的导航栏
    /*public function readUs(){
        $menu = CategoryModel::where('pid',9)->field('id,name,pid,type,model_id')->select();
        if($menu){
            return jsonp($menu)->contentType("text/plain");
        }else{
            //抛出Http异常，并发送404状态码
            abort(404,'用户不存在');
        }
    }*/
}
