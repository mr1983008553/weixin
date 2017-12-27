<?php namespace system\model;
use houdunwang\model\Model;
class Category extends Model{
    //数据表
    protected $table = "category";

    //允许填充字段
    protected $allowFill = [ '*' ];
    //自动验证
    protected $validate=[
        //['字段名','验证方法','提示信息',验证条件,验证时间]
        ['cname','isnull','请输入栏目名称',self::MUST_VALIDATE,self::MODEL_BOTH],
        ['orders','isnull','请输入排序',self::MUST_VALIDATE,self::MODEL_BOTH],
        ['is_cate','isnull','请选择上是否为封面栏目',self::MUST_VALIDATE,self::MODEL_BOTH],

    ];
    //时间操作,需要表中存在created_at,updated_at字段
    protected $timestamps=true;

    /**
     * 获取栏目所有数据并且转为树状结构
     * @return mixed
     */
    public function getCateTreeData(){
        $data = Db::table('category')->get();
        return  Arr::tree($data, 'cname', 'id', 'pid');
    }

    /**
     * 添加
     * @param $post
     *
     * @return array
     */
    public function store($post){
        //1.执行数据验证
        //2.执行添加
        //执行save会触发自动验证
        $this->save ($post);
        return ['valid'=>1,'msg'=>'操作成功'];

    }

    /**
     * 编辑数据
     * @param $post		post数据
     * @param $id		编辑数据主键id
     *
     * @return array
     */
    public function edit($post,$id){
        $model = Category::find($id); // 查找主键为1的数据
        $model->save($post); // 保存当前数据对象
        return ['valid'=>1,'msg'=>'操作成功'];
    }

    /**
     * 获取所属栏目数据(不包含自己和自己子集)
     */
    public function getCateData($id){
        //1.找到自己的所有子集数据(递归)
        $data = Db::table('category')->get();
        $cids = $this->getSon($data,$id);
        //2.找见自己
        $cids[] = $id;
        //3.将自己个子集踢出去,并且转树状结构
        //Db::table('user')->whereNotIn('id',[3,5,6])->get();
        $data = Db::table('category')->whereNotIn('id',$cids)->get();
        return Arr::tree($data,'cname','id','pid');
    }

    /**
     * 递归找子集
     * @param $data	所有栏目数据
     * @param $id	主键id
     *
     * @return array	所有的子集id集合
     */
    public function getSon($data,$id){
        //p($id);
        //p($data);die;
        static $temp = [];
        foreach ($data as $k=>$v){
            if($v['pid']==$id){
                $temp[] = $v['id'];
                $this->getSon ($data,$v['id']);
            }
        }
        return $temp;
    }


}