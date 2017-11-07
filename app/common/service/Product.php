<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/20
 * Time: 9:46
 */
namespace app\common\service;

use app\common\model\Product as ProductModel;

class Product extends ProductModel
{
    /**
     * 获取产品列表
     */
    public function getProducts($categoryId = null){

        $map = [];
        if($categoryId) $map["category_id"] = $categoryId;
        $product= $this::where($map)->field('p_text',true)->order("id asc")->paginate();
        if($product){
            return $product;
        }else{
            $this->error = "还没有作品";
            return false;
        }
    }

    /**
     * 保存产品
     * @param array $data
     */
    public function saveProduct($data)
    {
        try {
            if(isset($data["id"])) { // 更新
                $product = $this::get($data["id"]);
                if(!$product) return false;
                $product->allowField(true)->save($data);
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
     * 获取指定产品
     *
     * @param integer $id
     * @parame integer $status
     * @return mixed
     */
    public static function getProductById($id)
    {
        $map["id"] = $id;
        $product = parent::get($map);
        // 获取内容图片
        $map['id'] = array('lt',$id);
        $prev = self::where($map)->order("id desc")->field("id")->limit(1)->find();
        if($prev)  $prev->url = url('detail/index','mid=1&id='.$prev->id);
        $map['id'] = array('gt',$id);
        $next = self::where($map)->order("id asc")->field("id")->limit(1)->find();
        if($next) $next->url = url('detail/index','mid=1&id='.$next->id);
        $product->prev = $prev;
        $product->next = $next;

        if($product){
            return $product;
        }else{
            return false;
        }
    }
    /**
     * 删除指定作产品
     *
     * @param array $data
     * @return bool
     */
    public function deleteProduct($id)
    {
        $product = $this::get($id);
        if($product){
            try {
                $product->delete();
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