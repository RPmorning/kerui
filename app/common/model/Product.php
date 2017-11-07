<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/19
 * Time: 11:36
 */
namespace app\common\model;

use think\Model;

class Product extends Model{

    //开启自动写入时间戳
    protected $autoWriteTimestamp = true;

    //create_date读取器
    protected function getCreateTimeAttr($crate_time){
        return date('Y-m-d',$crate_time);
    }
    //update_date读取器
    protected function getUpdateTimeAttr($update_time){
        return date('Y-m-d',$update_time);
    }
    //cover读取器
    protected function getCoverAttr($cover){
        $request = request();
        return $request->domain().'/upload/'.$cover;
    }

}