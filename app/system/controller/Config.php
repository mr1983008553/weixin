<?php namespace app\system\controller;

use houdunwang\route\Controller;
use system\model\Config as ConfigModel;
class Config extends Controller{
    public function __construct ()
    {
        //auth函数我们自定义的函数。放在system/helper.php
        auth ();
    }
    //动作
    public function index(ConfigModel $config){

        //此处书写代码...
        if(Request::isMethod('post')){
            $res = $config->post(Request::post());
            if($res['valid']){
                return message ($res['msg'],'refresh','success');
            }else{
                return message ($res['msg'],'back','error');
            }
        }
        //获取数据表中数据
        $field = ConfigModel::find(1);
        $field = json_decode ($field['system_config'],true);
        //p($field);die;
        return view ('',compact ('field'));
    }
}
