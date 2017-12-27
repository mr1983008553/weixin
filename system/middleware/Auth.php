<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;

class Auth implements Middleware{
	//执行中间件
	public function run($next) {
         //验证登录
			if(!Session::has('username')){
				//回到登录页面
				return go('admin.login.index');
			}
         $next();
	}
}