<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2018/1/19-0019
 * Time: 10:31
 */
namespace app\common\service;

use \app\common\model\Log as LogModel;

class Log extends LogModel
{
    public function getLogs(){

        $data = LogModel::order('id desc')->paginate();
        if($data){
            return $data;
        }
    }

    public function searchLogs($res){

        $s_time = strtotime($res['s_time'] .' 00:00:00');
        $e_time = strtotime($res['s_time'] .' 23:59:59');

        $data = LogModel::where('created_time','>=',$s_time)
            ->where('created_time','<=',$e_time)
            ->paginate();
        if($data){
            return $data;
        }
    }

}