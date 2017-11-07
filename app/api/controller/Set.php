<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/30
 * Time: 9:11
 */
namespace app\api\controller;

use app\common\model\Config as ConfigModel;

class Set{
    //获得网站的配置信息
    public function index(){
        $data = ConfigModel::get(['option_name'=>'site_options']);
        if($data){
            return jsonp($data)->contentType("text/plain");
        }else{
            //抛出Http异常，并发送404状态码
            abort(404,'设置不存在');
        }
    }
}
