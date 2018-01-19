<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2018/1/19-0019
 * Time: 9:18
 */
namespace app\admin\controller;

use app\common\service\Action as ActionService;

class Action extends Base
{
    protected $action;

    public function __construct(ActionService $action)
    {
        parent::__construct();
        $this->action = $action;
    }

    public function log(){
        $this->pageTitle = "日志管理";
        $this->assign('pageTitle',$this->pageTitle);
        $this->assign('logs',$this->action->getLogs());

        return $this->action->getLogs();

        return $this->featch();
    }

}