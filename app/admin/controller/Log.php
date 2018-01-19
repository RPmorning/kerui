<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2018/1/19-0019
 * Time: 10:26
 */
namespace app\admin\controller;

use app\common\service\Log as LogService;

class Log extends Base
{
    protected $log;
    protected $category;

    public function __construct(LogService $log)
    {
        parent::__construct();
        $this->log = $log;
    }

    public function index(){
        $this->pageTitle = '日志管理';
        $this->assign('pageTitle',$this->pageTitle);

        $logs = $this->log->getLogs();

        if($logs){
            $this->assign('logs',$logs);
        }

//        dump(collection($logs)->toArray());
//        die();
        return $this->fetch();

    }
}
