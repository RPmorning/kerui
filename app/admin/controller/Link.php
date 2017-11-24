<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/29
 * Time: 13:40
 */
namespace app\admin\controller;

use app\common\service\Category as CategoryService;
use app\common\service\Link as LinkService;

class Link extends Base{
    protected $category;
    protected $link;

    public function __construct(LinkService $link){
        parent::__construct();
        $this->link = $link;
    }

    /**
     * @param null $cid
     * 显示该链接模板
     */
    public function index($cid = null){
        $this->pageTitle="友情链接";
        $this->assign('pageTitle',$this->pageTitle);
        $this->assign('link',$this->link->getLink($cid));
        return $this->fetch();
    }

    /**
     * @param $id
     * 显示标题：链接列表
     */
    public function read($id){
        $this->assign('link',$this->link->getLink($id));
        $data = $this->fetch('link');
        return $this->success('链接列表',urel('index'),$data);
    }

    /**
     * 保存新的链接
     */
    public function save(){
        $data = $this->request->post();
        $res = $this->link->saveLink($data);
        if($res){
            return $this->success('保存成功',url('index'));
        }else{
            return $this->error($this->category->getError());
        }
    }

    /**
     * @param $id
     * 编辑衔接
     */
    public function edit($id){
        $link=  $this->link->getlinkById($id);
        if($link){
            $this->assign("link", $link);
            $data = $this->fetch();
            return $this->success("编辑链接", url("index"), $data);
        }else{
            return $this->error("编辑失败");
        }
    }

    /**
     * @param $id
     * 删除指定的链接
     */
    public function delete($id){
        $res = $this->link->deleteLink($id);
        if($res){
            return $this->success('删除成功',url('index'));
        }else{
            return $this->error($this->category->getError());
        }
    }

    /**
     * @param $id
     * @param $status
     * 更新链接的状态
     */
    public function status($id, $status)
    {
        $res = $this->link->updateStatus($id, $status);
        if($res){
            return $this->success("更新成功");
        }else{
            return $this->error("更新失败");
        }
    }
}