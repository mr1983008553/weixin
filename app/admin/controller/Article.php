<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use module\Wechat;
use system\model\Category;
use system\model\Article as ArticleModel;

class Article extends Controller
{
    use Wechat;
    public function __construct ()
    {
        //auth函数我们自定义的函数。放在system/helper.php
        auth ();
    }

    /**
     * 文章数据展示
     * @return mixed
     */
    public function index ()
    {
        //关联模型列子
        //$res  = ArticleModel::find(1);
        ////$res，打印之后是article模型对象
        //$newRes = $res->category();
        //p($newRes->cname);
        ////相当于
        //die;
        $num = v('system.arc_num') ? : 20;

        $field = ArticleModel ::paginate ( $num );

        return view ( '' , compact ( 'field' ) );
    }

    /**
     * 文章数据添加
     *
     * @param Category     $category 分类模型
     * @param ArticleModel $article  文章模型
     *
     * @return mixed|string
     */
    public function store ( Category $category , ArticleModel $article )
    {
        if ( Request ::isMethod ( 'post' ) ) {
            $res = $article -> store ( Request ::post () );
            if ( $res[ 'valid' ] ) {
                return message ( $res[ 'msg' ] , u ( 'index' ) , 'success' );
            }
            else {
                return message ( $res[ 'msg' ] , 'back' , 'error' );
            }
        }
        //获取所有栏目数据，并转为树状结构
        $cateData = $category -> getCateTreeData ();

        return view ( '' , compact ( 'cateData' ) );
    }

    /**
     * 文章数据编辑
     *
     * @param Category     $category
     * @param ArticleModel $article
     *
     * @return mixed|string
     */
    public function edit ( Category $category , ArticleModel $article )
    {
        //获取编辑的是数据主键id
        $id = Request ::get ( 'id' , 0 , 'intval' );
        if ( Request ::isMethod ( 'post' ) ) {
            $res = $article -> edit ( Request ::post () , $id );
            if ( $res[ 'valid' ] ) {
                return message ( $res[ 'msg' ] , u ( 'index' ) , 'success' );
            }
            else {
                return message ( $res[ 'msg' ] , 'back' , 'error' );
            }
        }
        //获取旧数据
        $oldData = ArticleModel ::find ( $id );
        //获取所有栏目数据，并转为树状结构
        $cateData = $category -> getCateTreeData ();

        return view ( '' , compact ( 'oldData' , 'cateData' ) );
    }

    /**
     * 文章数据删除
     * @return mixed|string
     */
    public function del ()
    {
        $id = Request ::get ( 'id' , 0 , 'intval' );
        ArticleModel ::delete ( $id );
        //删除关键词
        $this->delKeyword (['bc_id'=>$id,'module_name'=>'article']);
        return message ( '操作成功' , u ( 'index' ) , 'success' );
    }
}
