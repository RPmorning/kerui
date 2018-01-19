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

        $data = LogModel::paginate();
        if($data){
            return $data;
        }
    }

}