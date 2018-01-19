<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2018/1/19-0019
 * Time: 10:29
 */
namespace app\common\model;

use think\Model;

class Log extends Model
{

    protected $table = 'rp_logs';


    //create_date读取器
    protected function getCreatedTimeAttr($created_time){
        return date('Y-m-d h:i:s',$created_time);
    }

    //定义关联
    public function member()
    {
        return  $this->belongsTo("Member")->field('*');
    }
}