<?php
namespace module;

use houdunwang\route\Controller;

/**
 * 模块的公用控制器类
 * Class HdController
 *
 * @package module
 */
class HdController extends Controller
{
    use Wechat;//导入wecaht  trait类
    /**
     * 加载模块的模板文件
     * @param string $tpl
     *
     * @return mixed
     */
    public function template($tpl = '',$arg = []){
        //return view ('module/base/template/entry/index.php');
        //；这几个常量在app/home/Entry.php里面运行模块的方法中声明的
        $tpl = (IS_SYSTEM==1?'module':'addons') . "/" . HD_MODULE . '/template/' . strtolower (HD_CONTROLLER) . '/' . ($tpl ? : HD_ACTION) . '.php';
        //p($tpl);die;

        return view ($tpl,$arg);
    }
}
