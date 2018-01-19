<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2016/10/10
 * Time: 15:08
 */

namespace app\common\controller;

use app\common\model\Log;
use think\Controller;
use think\Request;
use app\common\service\Config;

class Common extends Controller
{
    protected $request;
    /**
     * 页面标题
     * @var string
     */
    protected $pageTitle;

    public function _initialize()
    {
        if (null === $this->request) {
            $this->request = Request::instance();
        }
        if (!defined('MODULE_NAME')) define('MODULE_NAME', strtolower($this->request->module()));
        if (!defined('CONTROLLER_NAME')) define('CONTROLLER_NAME', strtolower($this->request->controller()));
        if (!defined('ACTION_NAME')) define('ACTION_NAME', strtolower($this->request->action()));
        if (!defined('URL_NAME')) define('URL_NAME', strtolower($this->request->url()));

        $this->assign('pageTitle', $this->pageTitle);
        $this->assign("siteOption", Config::getSiteOption());
    }

    public function saveLog($memberid=0,$behavior=''){
        Log::create([
            'member_id' => $memberid,
            'member_ip' => request()->ip(),
            'behavior'  => $behavior,
            'created_time' => time(),
        ]);

    }

    /*//空操作
    public function _empty(){
        $this->error(lang('operation not valid'));
    }*/


}