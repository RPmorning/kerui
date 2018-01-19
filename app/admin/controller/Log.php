<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2018/1/19-0019
 * Time: 10:26
 */
namespace app\admin\controller;

use app\common\service\Log as LogService;
use think\Request;

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
        $this->pageTitle = '日志列表';
        $this->assign('pageTitle',$this->pageTitle);

        $logs = $this->log->getLogs();

        if($logs){
            $this->assign('logs',$logs);
        }

        return $this->fetch();
    }

    public function search(Request $request){
        $res = $request->param();

        $logs = $this->log->searchLogs($res);

        if($logs){
            $this->assign('logs',$logs);
        }

        $this->assign('search',$res);

        return $this->fetch('index');

    }
}
