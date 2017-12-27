<?php
/** .-------------------------------------------------------------------
 * | 函数库
 * '-------------------------------------------------------------------*/
if(!function_exists ('auth')){
    /**
     * 后台登录权限验证
     */
    function auth(){
        Middleware::set('auth');
    }
}

if(!function_exists ('url')){
    function url($url,$arg = []){
        //	p($url);die;//base.entry.index
        $info = explode ('.',$url);
        //p($info);
        //index.php?action=base/entry/index
        $arg = $arg ? "&".http_build_query ($arg) : '';
        return __ROOT__ . "/index.php?action={$info[0]}/{$info[1]}/{$info[2]}" . $arg;
    }
}