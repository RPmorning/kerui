<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2018/1/19-0019
 * Time: 9:22
 */
namespace app\common\model;

use think\Model;

class Action extends Model
{
    // 开启自动写入时间戳字段 可以在数据库配置文件中添加全局设置
    protected $autoWriteTimestamp = true;

    //create_date读取器
    protected function getCreateTimeAttr($crated_time){
        return date('Y-m-d h:i:s',$crated_time);
    }
}