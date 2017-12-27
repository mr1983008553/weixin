<?php
namespace module\article\system;
use module\base\model\BaseContent;
use module\HdProcessor;
use system\model\Article;
use houdunwang\route\Controller;

/**
 * 微信处理器
 * Class Processor
 *
 * @package module\base\system
 */
class Processor extends Controller
{
    /**
     * @param $bc_id   文章表的主键id
     */
    public function handler($bc_id){
        //1.根据回复表的主键id，获取对应的回复内容
        ///$contentData = BaseContent::find($bc_id);
        //$instance = WeChat ::instance ( 'message' );
        //$instance -> text ( $contentData['content'] );//向用户回复消息
        $arcData = Article::find($bc_id);
        $news=array(
            array(
                'title'=>$arcData['title'],
                'discription'=>$arcData['description'],
                'picurl'=>__ROOT__ . '/' . $arcData['prev'],
                'url'=>$arcData['link_url']
            ),
        );
//        $this->news($news);
        $instance = WeChat ::instance ( 'message' );
        $instance -> news ( $news );



        //$instance = WeChat::instance('message');
        //	//向用户回复消息
        //	$news=array(
        //		array(
        //			'title'=>$arcData['title'],
        //			'discription'=>$arcData['description'],
        //			'picurl'=>__ROOT__ . '/' . $arcData['prev'],
        //			'url'=>$arcData['link_url']
        //		),
        //	);
        //	$instance->news($news);
    }
}
