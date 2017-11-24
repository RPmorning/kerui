<?php
/**
 * Created by PhpStorm.
 * User: renpeng
 * Date: 2017/11/24
 * Time: 9:35
 */
namespace app\common\validate;

use think\Validate;

class Menu extends Validate
{
    // 验证规则
    protected $rule = [
        ['name', 'require', '菜单名必填'],
        ['module', 'require', '模块名必填'],
        ['controller', 'require', '控制器必填'],
        ['action', 'require', '方法必填'],
    ];
}