<?php

namespace app\common\service;

use app\common\model\Article as ArticleModel;

class Article extends ArticleModel
{
    /**
     * 获取文章列表
     * @param int $categoryId 分类ID
     * @param int $status 状态
     * @return tree
     */
    public function getArticles($categoryId = null, $status = -1)
    {
        $map = [];
        $map["m_id"] = session('user_auth')['uid'];
        if($categoryId) $map["category_id"] = $categoryId;
        if($status == 1) $map["status"] = $status;
        $articles = $this::with("member")->where($map)->field('content',true)->order("id desc")->paginate();
        if($articles){
            return $articles;
        }else{
            $this->error = "还没有文章";
            return false;
        }
    }

    /**
     * 根据文章名称获取列表
     * @param int $categoryId 分类ID
     * @param int $status 状态
     * @return tree
     */
    public function getArticleByName($name)
    {
        $map = [];
        if($name) $map["name"] = ['like', '%' .$name . '%'];
        $map["status"] = 1;
        $articles = $this::with("member")->where($map)->field('content',true)->order("id desc")->paginate();
        if($articles){
            return $articles;
        }else{
            $this->error = "还没有文章";
            return false;
        }
    }


    /**
     * 保存文章
     * @param array $data
     */
    public function saveArticle($data)
    {
        try {
            if(isset($data["id"])) { // 更新
                $article = $this::get($data["id"]);
                if(!$article) return false;
                $article->allowField(true)->save($data);
            }else{ // 新增
                $this::allowField(true)->save($data);
            }
            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * 获取指定文章
     *
     * @param integer $id
     * @parame integer $status
     * @return mixed
     */
    public static function getArticleById($id, $status = -1)
    {
        $map["id"] = $id;
        if($status == 1) $map["status"] = 1;
        $article = parent::get($map, 'member');
        if($article){
            return $article;
        }else{
            return false;
        }
    }

    /**
     * 删除指定文章
     *
     * @param array $data
     * @return bool
     */
    public function deleteArticle($id)
    {
        $article = $this::get($id);
        if($article){
            try {
                $article->delete();
                return true;
            } catch (\Exception $e) {
                $this->error = $e->getMessage();
                return false;
            }
        }else{
            $this->error = "该文章不存在";
            return false;
        }
    }

    /**
     * 排序文章
     *
     * @param array $data
     * @return bool
     */
    public function updataSort($data)
    {
        $result = $this->saveAll($data);
        if($result) {
            return true;
        }else{
            $this->error = "排序失败";
            return false;
        }
    }

    /**
     * 更新指定资源状态
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function updateStatus($id, $status)
    {
        $res = $this->where('id', $id)->update(['status' => $status]);
        if($res){
            return true;
        }else{
            $this->error = "状态更新失败";
            return false;
        }
    }

    /**
     * 保存封面图片，不含数据库保存
     * @return array 成功返回网站参数配置，失败-返回-false
     */
    public function saveCover($file)
    {
        if(empty($file)) {
            $this->error = '请选择上传文件';
            return false;
        }
        static $upload = null;
        if (!$upload) {
            $upload = new \rp\Upload();
        }
        $info = $upload->uploadFile($file, "image");
        if($info){
            return $info;
        }else{
            $this->error = $upload->getError();
            return false;
        }
    }

    public function getArticleDetail($res){
        if($res['type'] == 1){
            $view = ArticleModel::where('id',$res['id'])->value('view');
            ArticleModel::where('id',$res['id'])->update(['view' => $view+1]);
        }
        $data  = ArticleModel::where('id',$res['id'])->find();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    //分享文章 发表在大厅
    public function shareArticle($id){
        $result = $this->where('id', $id)
            ->update(['tag' => 1,'share_time' => time()]);
        if($result) {
            return true;
        }else{
            $this->error = "发表失败";
            return false;
        }
    }
}