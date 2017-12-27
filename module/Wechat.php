<?php
namespace module;

use system\model\Keyword;

/**
 * 微信关键词处理
 * Trait Wechat
 *
 * @package module
 */
trait Wechat
{
    /**
     * 保存关键词数据
     * @param $data
     */
    public function saveKeyword($data){
        //p($data);die;
        //编辑时候修改$keywordModel
        //获取keyword表的主键id
        $where=[
            ['bc_id',$data['bc_id']],
            ['module_name',$data['module_name']]
        ];
        //p($where);die;
        //p($where);die;
        $id = Keyword::where($where)->pluck('id');
        //dd($id);die;
        //如果$id=null,说明是新增，如果有值说明是更新
        $keywordModel = $id ? Keyword::find($id) :new Keyword();
        $keywordModel->save($data);
    }


    /**
     * 删除关键词数据
     * @param $id
     */
    public function delKeyword($data){
        //$data = ['id'=>1,'module_name'=>'base'];
        $where=[
            ['bc_id',$data['bc_id']],
            ['module_name',$data['module_name']]
        ];
        Keyword::where($where)->delete();
    }
}