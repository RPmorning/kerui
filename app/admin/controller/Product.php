<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/20
 * Time: 9:33
 */
namespace app\admin\controller;

use app\common\service\Product as ProductService;
use app\common\service\Category as CategoryService;

class Product extends Base
{
    protected $product;
    protected $category;

    public function __construct(ProductService $product, CategoryService $category)
    {
        parent::__construct();
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * 显示指定模型的字段列表
     * @param int @cid 栏目分类ID
     * @return \think\Response
     */
    public function index($cid = null)
    {
        $this->pageTitle = "产品中心";
        $this->assign('pageTitle', $this->pageTitle);
        $this->assign("categorys", $this->category->getCategorysByType(1, 1));
        $this->assign("product", $this->product->getProducts($cid));
        return $this->fetch();
    }
    /**
     * 根据栏目ID显示资源
     * @param int $cid 分类ID
     */
    public function read($cid)
    {
        $this->assign("categorys", $this->category->getCategorysByType(1, 1));
        $this->assign("product", $this->product->getProducts($cid));
        $data = $this->fetch("list");
        return $this->success("产品列表", url("index"), $data);
    }

    /**
     * 编辑产品
     *
     * @param int $id
     * @param int $pid
     * @return \think\Response
     */
    public function edit($id)
    {
        $product=  $this->product->getProductById($id);
        if($product){
            $this->assign("categorys", $this->category->getCategorysByType(1,1));
            $this->assign("product", $product);
            $data = $this->fetch();
            return $this->success("编辑产品", url("index"), $data);
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
        $res = $this->product->saveProduct($data);
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
        $res = $this->product->deleteProduct($id);
        if($res) {
            return $this->success("删除成功", url("index"));
        }else{
            return $this->error("删除失败");
        }
    }

    /**
     * 上传封面图
     * @return \think\response\Json
     */
    public function cover()
    {
        $file = $this->request->file("cover");
        $path = $this->product->saveCover($file);
        if($path){
            $data = ['path' => $path, 'code' => '1'];
        }else{
            $data = ['msg' => $this->config->getError(), 'code' => '0'];
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
        $path = $this->product->saveCover($file);
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
                'msg' =>  $this->product->getError(),
                'data' => [
                    'src' => ''
                ]
            ];
        }
        return json($result, 200);
    }
}