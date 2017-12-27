<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com  www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace app\home\controller;

use houdunwang\route\Controller;
use system\model\Module;

class Entry extends Controller
{
    public function __construct ()
    {
        //运行模块
        $this->runModule();
    }

    /**
     * 运行模块index.php?action=base/entry/index
     */
    private function runModule()
    {
        $action = Request::get('action');//"base/entry/index"
        //dd($action);
        //将字符串拆分为数组
        $info = explode ('/',$action);
        //p($info);
        //查看该模块是否为系统模块
        //pluck获取单一一个字段的值
        //如果地址栏没有action参数，$is_system值为null
        $is_system = Module::where('name',$info[0])->pluck('is_system');
        //如果有action参数并且is_system为真(在module表中可以找见这条数据)
        if($action && $is_system){
            //在处理模块加载模板的时候新增常量
            define ('HD_MODULE',$info[0]);
            define ('HD_CONTROLLER',$info[1]);
            define ('HD_ACTION',$info[2]);
            define ('IS_SYSTEM',$is_system);
            //组合类名
            $class =  ($is_system==1?'module':'addons') . "\\{$info[0]}\controller\\" . ucfirst ($info[1]);
            //p($class);die;//module\base\controller\Entry
            $ac = $info[2];
            //(new $class)->$ac();
            //(new \module\base\controller\Entry())->index();
            die(call_user_func_array ([new $class,$ac],[]));
        }
    }

    public function index()
    {
        //(new \module\base\controller\Entry())->index();
        //(new Demo())->index ();
        return View::with('framework', 'HDPHP')->make();
    }
}