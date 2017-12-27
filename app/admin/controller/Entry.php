<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use system\model\Admin;

class Entry extends Controller{
    public function __construct ()
    {
        //auth函数我们自定义的函数。放在system/helper.php
        auth ();
    }
    //动作
    public function index(){
        //此处书写代码...
		//加载模板文件
		//return View::make();
		return view ();
    }

	/**
	 * 修改密码
	 * @param Admin $admin	Admin模型
	 *
	 * @return mixed|string
	 */
    public function changePass(Admin $admin){
    	if(Request::isMethod('post')){
    		$res = $admin->changePass(Request::post());
    		if($res['valid']){
    			return message ($res['msg'],'refresh','success');
			}else{
				return message ($res['msg'],'back','error');
			}
		}
    	return view ();
	}

	/**
	 * 退出登录
	 * @return mixed
	 */
	public function out(){
		Session::flush();
		return go('admin.login.index');
	}
}
