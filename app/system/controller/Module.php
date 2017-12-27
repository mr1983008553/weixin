<?php namespace app\system\controller;

use houdunwang\route\Controller;
use houdunwang\validate\Validate;
/**
 * 模块管理控制器类
 * Class Module
 *
 * @package app\system\controller
 */
class Module extends Controller{
    //动作
    public function index(){
    	//1.参考框架手册目录操作--目录树
		$addonsData = Dir::tree('addons');
		//p($addonsData);die;
		//2.筛选出合法的模块(模块中有manifest.php配置文件的)
		$field = [];
		foreach ($addonsData as $k=>$v){
			if(is_file ($v['path'] . '/manifest.php')){
				$field[] = include $v['path'] . '/manifest.php';
			}
		}
		//p($field);
        return view ('',compact ('field'));
    }

	/**
	 * 设计模块
	 * @return mixed|string
	 */
    public function design(){
    	if(Request::isMethod('post')){
    		//1.验证数据不能为空
			$post = Request::post();
			$res = Validate::make( [
				[ 'name', 'isnull', '请输入模块英文标识', Validate::MUST_VALIDATE ],
				[ 'title', 'isnull', '请输入模块中文名称', Validate::MUST_VALIDATE ],
				[ 'description', 'isnull', '请输入模块描述', Validate::MUST_VALIDATE ],
				[ 'preview', 'isnull', '请输入模块预览图', Validate::MUST_VALIDATE ],
			] ,$post);
			//3.检测创建的模块上是否已经存在
			if(is_dir ('addons/' . $post['name'])){
				return message ('模块已存在','back','error');
			}
			//2.生成目录结构
			$dirs = ['controller','model','template','system'];
			foreach ($dirs as $dir){
				mkdir ('addons/'.$post['name'] . '/' .$dir,0777,true);
			}
			//4.生成模块对应配置文件
			file_put_contents ('addons/' . $post['name'] . '/manifest.php', "<?php\r\nreturn " . var_export ($post,true) . ";\r\n?>");
			//5.生成system/Processor文件
			$str = <<<str
<?php
namespace addons\\{$post['name']}\system;
use module\HdProcessor;

/**
 * 微信处理器
 * Class Processor
 *
 * @package addons\\{$post['name']}\system
 */
class Processor extends HdProcessor
{
	/**
	 * @param \$bc_id   文章表的主键id/回复表的主键id
	 */
	public function handler(\$bc_id){

	}
}
str;
			file_put_contents ('addons/'.$post['name'] .'/system/Processor.php',$str);
			return message('模块创建成功',u('index'),'success');
		}
    	return view ();
	}
}
