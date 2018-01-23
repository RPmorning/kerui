<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/6/29
 * Time: 14:22
 */
namespace app\common\service;
use app\common\model\Link as LinkModel;

class Link extends LinkModel{

    //获取链接列表
    public function getLink($status = null){
        $map = [];
        $map["m_id"] = session('user_auth')['uid'];
        if($status) $map["status"] = $status;
        $link= parent::where($map)->paginate();
        if($link){
            return $link;
        }else{
            return false;
        }
    }

    /**
     * @param $data
     * @return bool
     * 保存新的链接
     */
    public function saveLink($data){
        try{
            if(isset($data["id"])){  //更新
                $link = $this::get($data["id"]);
                if(!$link){
                    return false;
                }
                $link->allowField(true)->save($data);
            }else{  //保存
                $this::allowField(true)->save($data);
            }
            return true;
        }catch (\Exception $e){
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * @param $id
     * @return bool|null|static
     * 获取指定的链接
     */
    public function getLinkById($id)
    {
        $link = $this::get($id);
        if($link){
            return $link;
        }else{
            $this->error = "该链接不存在";
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     * 删除指定链接
     */
    public function deleteLink($id)
    {
        $link = $this::get($id);
        if($link){
            try {
                $link->delete();
                return true;
            } catch (\Exception $e) {
                $this->error = $e->getMessage();
                return false;
            }
        }else{
            $this->error = "该链接不存在";
            return false;
        }
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * 跟新指定链接的状态
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
}