<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/26
 * Time: 9:48
 */
namespace app\admin\controller;

use app\common\service\Category as CategoryService;
use app\common\service\Page as PageService;

class Page extends Base{
    protected $page;
    protected $category;

    public function __construct(PageService $page, CategoryService $category)
    {
        parent::__construct();
        $this->page = $page;
        $this->category = $category;
    }

    /**
     * 显示指定模型的字段名
     * @param int @cid 栏目分类ID
     * @return \think\response
     */
    public function index($cid = null){
        $this->pageTitle = '专题中心';
        $this->assign('pageTitle',$this->pageTitle);
        $this->assign("categorys", $this->category->getCategorysByType(1, 2));
        $this->assign('page',$this->page->getPage($cid));
        return $this->fetch();
    }

    /**
     * @param $cid
     * 根据栏目id显示专题
     */
    public function read($cid){
        $this->assign("categorys",$this->category->getCategorysByType(1,2));
        $this->assign("page",$this->page->getPage($cid));
        $data = $this->fetch("list");
        return $this->success("专题列表",url("index"),$data);
    }

    /**
     * 保存专题
     */
    public function save(){
        $data = $this->request->post();
        $res  = $this->page->savePage($data);
        if($res){
            return $this->success("保存成功",url("index"));
        }else{
            return $this->error($this->category->getError());
        }
    }

    /**
     * @param int $id
     * @param int $pid
     * @return \think\Response
     * 编辑专题
     */
    public function edit($id)
    {
        $page=  $this->page->getPageById($id);
        if($page){
            $this->assign("categorys", $this->category->getCategorysByType(1,2));
            $this->assign("page", $page);
            $data = $this->fetch();
            return $this->success("编辑产品", url("index"), $data);
        }else{
            return $this->error("编辑失败");
        }
    }
    /**
     * 删除指定专题
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $res = $this->page->deletePage($id);
        if($res) {
            return $this->success("删除成功", url("index"));
        }else{
            return $this->error("删除失败");
        }
    }

    /**
     * @param $id
     * @param $status
     * 专题状态的更新
     */
    public function status($id, $status)
    {
        $res = $this->page->updateStatus($id, $status);
        if($res){
            return $this->success("保存成功");
        }else{
            return $this->error("保存失败");
        }
    }

    /**
     * 编辑器图片上传
     * @return \think\response\Json
     */
    public function file()
    {
        $file = $this->request->file("file");
        $path = $this->page->saveCover($file);
        if($path){
            $result = [
                'code' => 0,
                'data' => [
                    'src' => config('upload')['path'] . DS . $path
                ]
            ];
        }else{
            $result = [
                'code' => 1,
                'msg' =>  $this->page->getError(),
                'data' => [
                    'src' => ''
                ]
            ];
        }
        return json($result, 200);
    }
}