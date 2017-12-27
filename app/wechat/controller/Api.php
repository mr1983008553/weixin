<?php namespace app\wechat\controller;

use houdunwang\route\Controller;
use system\model\Config;
use system\model\Keyword;
use system\model\Module;

/**
 * 微信对接接口
 * Class Api
 *
 * @package app\wechat\controller
 */
class Api extends Controller
{
    //构造方法
    public function __construct ()
    {
        WeChat ::valid ();
    }

    //动作
    public function index ()
    {
        //消息管理模块,实例化消息类
        $instance = WeChat ::instance ( 'message' );
        //获取后台设置的消息回复【关注回复和默认回复】
        $responseData = json_decode ( Config ::find ( 1 ) -> wechat_response , true );
        //判断是否是关注事件
        if ( $instance -> isSubscribeEvent () ) {
            $instance -> text ( $responseData[ 'welcome' ] );//向用户回复消息
        }
        //获取粉丝发来的消息内容
        $content = WeChat ::content ( 'Content' );
        $this -> parseKeyword ( $content );
        //默认回复
        if ( $instance -> isTextMsg () ) {
            $instance -> text ( $responseData[ 'default' ] );//向用户回复消息
        }
    }

    private function parseKeyword ( $content )
    {
        //1.在关键词表中进行匹配
        $keywordData = Keyword ::where ( 'keyword' , $content ) -> first ();
        //如果找见对应的关键词
        if ( $keywordData ) {
            //获取对应关键词所在的模块，看该模块是否系统模块
            //其结果为1(系统模块)或2（非系统模块）
            $is_system = Module ::where ( 'name' , $keywordData[ 'module_name' ] ) -> pluck ( 'is_system' );
            //(new \module\base\system\Processor)->handler ();
            $class = ( $is_system == 1 ? 'module' : 'addons' ) . "\\" . $keywordData[ 'module_name' ] .
                '\\system\Processor';

            return call_user_func_array ( [ new $class , 'handler' ] , [ $keywordData[ 'bc_id' ] ] );
        }
    }
}
