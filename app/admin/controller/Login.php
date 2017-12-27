<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use system\model\Admin;

/**
 * 后台登录管理控制器
 * Class Login
 *
 * @package app\admin\controller
 */
class Login extends Controller{
	/**
	 * 登录模板
	 * @return mixed
	 */
    public function index(Admin $admin){
    	//判断是否为post请求：参考手册：【函数常量--请求类型判断】
    	if(Request::isMethod('post')){
    		//调用Admin模型中login方法,将所有post提交的数据作为参数传递
    		$res = $admin->login(Request::post());
    		if($res['valid']){
    			//成功
				return message( $res['msg'], u('admin.entry.index'), 'success');

			}else{
    			//失败
				//return $this->setRedirect('back')->success($res['msg']);
				/**
				 * 消息提示
				 * $content 消息内容
				 * $redirect 跳转方式 1:with(分配错误内容) 2:back或为空(返回上一页)  3:refresh(刷新当前页)  4:具体跳转的Url
				 * $type 信息类型   success(成功），error(失败），warning(警告），info(提示）
				 * @timeout 等待时间单位秒
				 */
				return message( $res['msg'], 'back', 'error');
			}
		}
		return view ('login');
    }

	/**
	 * 验证码
	 */
    public function code(){
		Code::width(200)->height(70)->fontSize(35)->num(1)->make();
	}
}
