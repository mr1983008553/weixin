<?php namespace system\model;
use houdunwang\model\Model;
class Config extends Model{
    //数据表
    protected $table = "config";

    //自动验证
    protected $validate=[
        //['字段名','验证方法','提示信息',验证条件,验证时间]
    ];

    //时间操作,需要表中存在created_at,updated_at字段
    protected $timestamps=true;

    /**
     * 添加系统配置项
     * @param $post	post数据
     *
     * @return array
     */
    public function post($post){
        $model = Config::find(1) ? : new Config();

        $model->system_config = json_encode ($post,JSON_UNESCAPED_UNICODE);
        $model->save ();

        return ['valid'=>1,'msg'=>'操作成功'];
    }

    /**
     * 添加微信配置项
     * @param $post
     */
    public function postWechat($post){
        $model = Config::find(1) ? : new static();

        $model->wechat_config = json_encode ($post,JSON_UNESCAPED_UNICODE);
        $model->save ();
        return ['valid'=>1,'msg'=>'操作成功'];
    }

    /**
     * 添加微信回复数据
     * @param $post
     *
     * @return array
     */
    public function postWechatResponse($post){
        $model = Config::find(1) ? : new static();

        $model->wechat_response= json_encode ($post,JSON_UNESCAPED_UNICODE);
        $model->save ();
        return ['valid'=>1,'msg'=>'操作成功'];
    }
}