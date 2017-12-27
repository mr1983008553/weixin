<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use system\model\Category as CategoryModel;
/**
 * 栏目管理控制器类
 * Class Category
 *
 * @package app\admin\controller
 */
class Category extends Controller{
    public function __construct ()
    {
        //auth函数我们自定义的函数。放在system/helper.php
        auth ();
    }
	/**
	 * 栏目管理首页
	 */
    public function index(CategoryModel $category){
        //获取首页数据
        $field = $category->getCateTreeData ();
        //p($field);die;
        return view ('',compact ('field'));
    }

	/**
	 * 添加数据
	 * @param CategoryModel $category
	 *
	 * @return mixed|string
	 */
    public function store(CategoryModel $category){
        if(Request::isMethod('post')){
            $res = $category->store(Request::post());
            if($res['valid']){
                return message($res['msg'],u('index'),'success');
            }else{
                return message($res['msg'],'back','error');
            }
        }
        //获取栏目表中所有数据
        $cateData =  $category->getCateTreeData ();
        return view ('',compact ('cateData'));
    }

    /**
     * 编辑数据
     * @param CategoryModel $category
     *
     * @return mixed|string
     */
    public function edit(CategoryModel $category){
        //接受编辑数据主键id
        //q('id')
        $id = Request::get('id');
        //$id = q('id');
        if(Request::isMethod('post')){
            $res = $category->edit(Request::post(),$id);
            if($res['valid']){
                return message($res['msg'],u('index'),'success');
            }else{
                return message($res['msg'],'back','error');
            }
        }
        //旧数据
        $oldData = CategoryModel::find($id);
        //p($oldData);
        //处理所属栏目数据
        $cateData = $category->getCateData($id);
        //p($cateData);
        return view ('',compact ('oldData','cateData'));
    }

    /**
     * 删除数据
     * @return mixed|string
     */
    public function del(){
        //接受删除数据主键id
        $id = Request::get('id');//1
        //p($id);die;
        //判断如果删除的该数据有子集，不允许删除
        $sonData = CategoryModel::where('pid',$id)->first();
        if($sonData){
            //不允许删除
            return message ('有子集数据不允许删除','back','error');
        }
        //删除
        CategoryModel::delete($id);
        return message ('操作成功',u('index'),'success');
    }
}
