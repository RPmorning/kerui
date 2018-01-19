<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2018/1/19-0019
 * Time: 9:24
 */
namespace app\common\service;

use app\common\model\Action as ActionModel;

class Action extends ActionModel
{

    public function getLogs(){
        $date = ActionModel::getAll();
        if($date){
            return $date;
        }
    }

}