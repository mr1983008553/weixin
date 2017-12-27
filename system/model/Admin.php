<?php namespace system\model;
use houdunwang\model\Model;
use houdunwang\validate\Validate;

class Admin extends Model{
	//数据表
	protected $table = "admin";

	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps=true;

	/**
	 * 登录
	 * @param $post   post数据
	 *
	 * @return array
	 */
	public function login($post){
		//1.数据验证(不能为空)
		//自动验证：参考手册：【自动验证--验证数据】
		$res = Validate::make( [
			//参数：字段、验证规则、提示消息、验证条件
			[ 'username', 'isnull', '请输入用户名', Validate::MUST_VALIDATE ],
			[ 'password', 'isnull', '请输入密码', Validate::MUST_VALIDATE ],
			[ 'code', 'captcha', '验证码输入错误', Validate::MUST_VALIDATE ]
		] ,$post);
		//2.验证用户名是否正确
		$userInfo = $this->where('username',$post['username'])->first();
		//p($userInfo);die;
		if(!$userInfo){
			//说明用户名在数据表找不到
			//return ['成功还是失败的标识，1代表成功，0失败','提示消息'];
			return ['valid'=>0,'msg'=>'用户名不正确'];
		}
		//3.验证密码是否在正确
		//p($userInfo['password']);die;
		if(!password_verify ($post['password'],$userInfo['password']))
		{
			return ['valid'=>0,'msg'=>'密码不正确'];
		}
		//5.登录成功
		//将用户信息存入到session
		Session::set('id',$userInfo['id']);
		Session::set('username',$userInfo['username']);
		return ['valid'=>1,'msg'=>'登录成功'];
	}

	public function changePass($post){
		//1.验证数据不能为空
		$res = Validate::make( [
			//参数：字段、验证规则、提示消息、验证条件
			[ 'old_password', 'isnull', '请输入旧密码', Validate::MUST_VALIDATE ],
			[ 'password', 'isnull', '请输入新密码', Validate::MUST_VALIDATE ],
			[ 'confirm_password', 'confirm:password', '两次输入密码不一致', Validate::MUST_VALIDATE ]
		] ,$post);
		//2.验证原始密码正确
		$userInfo = $this->where('id',Session::get('id'))->first();
		//p($userInfo);die;
		if(!password_verify ($post['old_password'],$userInfo['password'])){
			return ['valid'=>0,'msg'=>'原始密码不正确'];
		}
		//3.执行修改
		$model = Admin::find(Session::get('id')); // 查找主键为1的数据
		$model->password = password_hash ($post['password'],PASSWORD_DEFAULT); // 修改数据对象
		$model->save(); // 保存当前数据对象
		return ['valid'=>1,'msg'=>'密码修改成功'];
	}
}