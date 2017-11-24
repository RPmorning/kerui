<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Time: 9:23
 */
namespace app\admin\controller;

use app\common\service\Article as ArticleService;
use app\common\service\Category as CategoryService;

class Article extends Base
{
    protected $article;
    protected $category;

    public function __construct(ArticleService $article)
    {
        parent::__construct();
        $this->article = $article;
    }

    /**
     * 显示指定模型的字段列表
     * @param int @cid 栏目分类ID
     * @return \think\Response
     */
    public function index($cid = null)
    {
        $this->pageTitle = "文章管理";
        $this->assign('pageTitle',$this->pageTitle);
        $this->assign("articles", $this->article->getArticles($cid));
        return $this->fetch();
    }

    /**
     * 根据栏目ID显示资源
     * @param int $cid 分类ID
     */
    public function read($cid)
    {
        $this->assign("articles", $this->article->getArticles($cid));
        $data = $this->fetch("list");
        return $this->success("文章列表", url("index"), $data);
    }
    /**
     * 编辑文章
     *
     * @param int $id
     * @param int $pid
     * @return \think\Response
     */
    public function edit($id)
    {
        $article=  $this->article->getArticleById($id);
        if($article){
            $this->assign("article", $article);
            $data = $this->fetch();
            return $this->success("编辑文章", url("index"), $data);
        }else{
            return $this->error("编辑失败");
        }
    }


    /**
     * 保存新建的资源
     *
     * @return \think\Response
     */
    public function save()
    {
        $data = $this->request->post();
        unset($data['file']);
        if(isset($data['covers'])){
            $data['cover'] = $data['covers'];
            unset($data['covers']);
        }
        $res = $this->article->saveArticle($data);
        if($res) {
            return $this->success("保存成功", url("index"));
        }else{
            return $this->error($this->category->getError());
        }

    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $res = $this->article->deleteArticle($id);
        if($res) {
            return $this->success("删除成功", url("index"));
        }else{
            return $this->error("删除失败");
        }
    }

    /**
     * 对资源进行排序
     *
     * @return \think\Request  $request
     */
    public function sort()
    {
        $param = $this->request->param();
        $res = $this->article->updataSort($param["param"]);
        if($res) {
            return $this->success("排序成功", url("index"));
        }else{
            return $this->error($this->category->getError());
        }
    }

    /**
     * 更新指定资源状态
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function status($id, $status)
    {
        $res = $this->article->updateStatus($id, $status);
        if($res){
            return $this->success("保存成功");
        }else{
            return $this->error("保存失败");
        }
    }

    /**
     * 上传封面图
     * @return \think\response\Json
     */
    public function cover()
    {
        $file = $this->request->file("file");
        $path = $this->article->saveCover($file);
        if($path){
            $data = ['path' => $path, 'code' => '0'];
        }else{
            $data = ['msg' => $this->article->getError(), 'code' => '1'];
        }
        return json($data, 200);
    }
    /**
     * 编辑器图片上传
     * @return \think\response\Json
     */
    public function file()
    {
        $file = $this->request->file("file");
        $path = $this->article->saveCover($file);
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
                'msg' =>  $this->article->getError(),
                'data' => [
                    'src' => ''
                ]
            ];
        }
        return json($result, 200);
    }
}