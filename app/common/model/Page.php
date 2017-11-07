<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/26
 * Time: 9:41
 */
namespace app\common\model;
use think\Model;

class Page extends Model{
    //开启自动写入时间戳
    protected $autoWriteTimestamp = true;

    //create_time 读取器
    protected function getCreateTimeAttr($create_date){
        return date('Y-m-d',$create_date);
    }

    //update_time 读取器
    protected function getUpdateTimeAttr($update_time){
        return date('Y-m-d',$update_time);
    }

}