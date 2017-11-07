<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/29
 * Time: 14:18
 */

namespace app\common\model;

use think\Model;

class Link extends Model{

    //开启自动写入时间戳
    protected $autoWriteTimestamp = true;

    //设置自动完成的属性
    protected $insert = ['status'=> 1];

    //时间读取器
    protected function getUpdateTimeAttr($update_time){
        return date('Y-m-d',$update_time);
}

}