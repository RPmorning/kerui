<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/22
 * Time: 9:29
 */
namespace app\api\controller;

use app\common\model\Product as ProductModel;

class Product {
    //获取产品信息by id
    public function read($id=''){
        $product = ProductModel::get($id);
        if($product){
            return jsonp($product)->contentType("text/plain");
        }else{
            //抛出Http异常，并发送404状态码
            abort(404,'用户不存在');
        }
    }
}