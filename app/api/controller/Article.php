<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/21
 * Time: 11:01
 */

namespace app\api\controller;
use app\common\model\Article as ArticleModel;
use think\Response;

class Article{
    //获取新闻列表
    public function index(){
        $article = ArticleModel::where('status',1)->order('id','desc')->field('id,name,desc,cover,update_time')->paginate();
        if($article){
            //dump($article);
            return jsonp($article)->contentType("text/plain");
        }else{
            //抛出Http异常，并发送404状态码
            abort(404,'无新闻内容');
        }
    }

    //获取指定新闻的信息
    public function read($id){
        $article = ArticleModel::get($id);
        //$article = $article->hidden(['tag','sort','hide','view','member_id','status']);
        if($article){
            return jsonp($article)->contentType("text/plain");
        }else{
            //抛出Http异常，并发送404状态码
            abort(404,'无此新闻内容');
        }
    }
}