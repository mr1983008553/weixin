<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use system\model\Config;
class Boot implements Middleware{
    //执行中间件
    public function run($next) {
        //加载系统配置项
        $this->loadSystemConfig();
        //加载微信配置项
        $this->loadWechatConfig();
        $next();
    }

    /**
     * 加载微信配置项数据
     */
    private function loadWechatConfig(){
        $field =  Config::find(1);
        $field = json_decode ($field['wechat_config'],true);
        //首先读取wechat配置文件中数据
        //array_merge(a,b)  数组a和数组b合并，
        \Config::set('wechat',array_merge (\Config::get('wechat'),$field));
        //p(\Config::get('wechat'));

    }

    /**
     * 加载系统配置项数据
     */
    private function loadSystemConfig(){
        //读取系统配置项的数据
        $field = Config::find(1);
        $field = json_decode ($field['system_config'],true);
        //将数据村给v函数中system
        v('system',$field);
    }


}