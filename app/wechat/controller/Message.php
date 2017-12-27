<?php namespace app\wechat\controller;

use houdunwang\route\Controller;
use system\model\Config;
/**
 * 微信关注消息和默认消息
 * Class Message
 *
 * @package app\wechat\controller
 */
class Message extends Controller{
    //动作
    public function index(Config $config){
        if(Request::isMethod('post')){
            $res = $config->postWechatResponse(Request::post());
            if($res['valid']){
                return message ($res['msg'],'refresh','success');
            }else{
                return message ($res['msg'],'back','error');
            }
        }
        //获取当前微信回复的数据
        $field = Config::find(1);
        $field = json_decode ($field['wechat_response'],true);
        return view ('',compact ('field'));
    }
}
