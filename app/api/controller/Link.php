<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/29
 * Time: 15:10
 */
namespace app\api\controller;
use app\common\model\Link as LinkModel;

class Link{
    public function index(){
        $link = LinkModel::all();
        if($link){
            return jsonp($link)->contentType('text/plain');
        }else{
            abort(404,'无此专题');
        }
    }
}