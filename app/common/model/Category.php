<?php

namespace app\common\model;

use think\Model;

class Category extends Model
{

    // 开启自动写入时间戳字段 可以在数据库配置文件中添加全局设置
    //protected $autoWriteTimestamp = true;

    // 设置自动完成的属性
    protected $insert = ['status' => 1];

    // 向模型追加属性
    protected $append  = ['type_text', 'model_text'];

    // 定义数据表中不存在的字段
    protected function getTypeTextAttr($value, $data)
    {
        $type = [0=>'内部栏目', 1=>'单网页', 2=>'外部链接'];
        return $type[$data['type']];
    }
    protected function getModelTextAttr($value, $data)
    {
        $type = [0=>'文章模型', 1=>'产品模型', 2=> '专题模型'];
        return $type[$data['model_id']];
    }

    /**
     * 获取栏目下的文章
     */
    public function article()
    {
        // 获取排除数据表中的content字段（文本字段的值非常耗内存）之外的所有字段值
        return $this->hasMany('Article')->field('content',true);
    }
    /**
     * 获取栏目下的产品
     */
    public function product()
    {
        return $this->hasMany('Product')->field('p_text',true);
    }
    /**
     * 获取专题内容
     */
    public function topic()
    {
        return $this->hasMany('Page')->field('content',true);
    }
}