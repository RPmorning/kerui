<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/26
 * Time: 9:54
 */
namespace app\common\service;

use app\common\model\Page as PageModel;

class Page extends PageModel{

    public function getPage($categoryId = null){
        $map = [];
        if($categoryId)
            $map['category_id']=$categoryId;
        $page = $this->where($map)->field('content',true)->order('id asc')->paginate();
        if($page){
            return $page;
        }else{
            $this->error = "还没有作品";
            return false;
        }
    }

    /**
     * @param $data
     * @return bool
     * 保存专题
     */
    public function savePage($data){
        try{
            if(isset($data["id"])){ //更新
                $page = $this::get($data["id"]);
                if(!$page){
                    return false;
                }
                $page->allowField(true)->save($data);
            }else{
                //新增
                $this::allowField(true)->save($data);
            }
            return true;
        }catch (\Exception $e){
            $this->error = $e->getMessage();
            return false;
        }
    }


    /**
     * 获取指定专题
     * @param integer $id
     * @parame integer $status
     * @return mixed
     */
    public static function getPageById($id)
    {
        $map["id"] = $id;
        $page = parent::get($map);
        // 获取内容图片
        $map['id'] = array('lt',$id);
        $prev = self::where($map)->order("id desc")->field("id")->limit(1)->find();
        if($prev)  $prev->url = url('detail/index','mid=1&id='.$prev->id);
        $map['id'] = array('gt',$id);
        $next = self::where($map)->order("id asc")->field("id")->limit(1)->find();
        if($next) $next->url = url('detail/index','mid=1&id='.$next->id);
        $page->prev = $prev;
        $page->next = $next;

        if($page){
            return $page;
        }else{
            return false;
        }
    }
    /**
     * 删除指定专题
     * @param array $data
     * @return bool
     */
    public function deletePage($id)
    {
        $page = $this::get($id);
        if($page){
            try {
                $page->delete();
                return true;
            } catch (\Exception $e) {
                $this->error = $e->getMessage();
                return false;
            }
        }else{
            $this->error = "该作品不存在";
            return false;
        }
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * 状态更新
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
            $upload = new \sckr\Upload();
        }
        $info = $upload->uploadFile($file, "image");
        if($info){
            return $info;
        }else{
            $this->error = $upload->getError();
            return false;
        }
    }
}