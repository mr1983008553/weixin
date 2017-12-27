<extend file='resource/view/admin/master'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li ><a href="{{u('index')}}" >栏目列表</a></li>
        <li class="active"><a href="" >栏目编辑</a></li>
    </ul>
    <!-- TAB CONTENT -->
    <form action="" method="POST" class="form-horizontal" role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">文章添加</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">文章标题</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" value="{{$oldData['title']}}" placeholder="请输入文章标题">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">文章作者</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="author" value="{{$oldData['author']}}" placeholder="请输入文章作者">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">是否热门</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="is_hot" value="1" <if value="$oldData['is_hot']==1">checked</if> >是
                            </label>
                            <label>
                                <input type="radio" name="is_hot" value="2" <if value="$oldData['is_hot']==2">checked</if>>否
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">是否推荐</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label>
                                <input type="radio" name="is_recommened" value="1" <if value="$oldData['is_recommened']==1">checked</if> >是
                            </label>
                            <label>
                                <input type="radio" name="is_recommened" value="2" <if value="$oldData['is_recommened']==2">checked</if> >否
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">所属栏目</label>
                    <div class="col-sm-10">
                        <select name="cid"  class="form-control">
                            <option value="0"> 请选择  </option>
                            <foreach from="$cateData" key="$k" value="$v">
                                <option value="{{$v['id']}}" <if value="$oldData['cid']==$v['id']">selected</if> >  {!!$v['_cname']!!}  </option>
                            </foreach>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">预览图</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input class="form-control" name="prev" readonly="" value="{{$oldData['prev']}}">
                            <div class="input-group-btn">
                                <button onclick="upImagePc(this)" class="btn btn-default" type="button">选择图片</button>
                            </div>
                        </div>
                        <div class="input-group" style="margin-top:5px;">
                            <img src="{{pic($oldData['prev'],'/node_modules/hdjs/dist/static/image/nopic.jpg')}}" class="img-responsive img-thumbnail" width="150">
                            <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片"
                                onclick="removeImg(this)">×</em>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">文章描述</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control" id="" cols="30" rows="3">{{$oldData['description']}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">关键词</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="arc_keyword" value="{{$oldData['arc_keyword']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">原文链接</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="link_url" value="{{$oldData['link_url']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">文章内容</label>
                    <div class="col-sm-10">
                        <textarea id="container" name="content" style="height:300px;width:100%;">{{$oldData['content']}}</textarea>
                        <script>
                            require(['hdjs'], function (hdjs) {
                                hdjs.ueditor('container', {hash: 2, data: 'hd'}, function (editor) {

                                });
                            })
                        </script>
                    </div>
                </div>

                <!--<div class="form-group">-->
                <!--    <label for="" class="col-sm-2 control-label">简洁版编辑器</label>-->
                <!--    <div class="col-sm-10">-->
                <!--        <textarea id="hdphp" style="height:300px;width:100%;"></textarea>-->
                <!--        <script>-->
                <!--            require(['hdjs'], function (hdjs) {-->
                <!--                hdjs.ueditor('hdphp', {'toolbars': [['fullscreen', 'source', 'hdimage', 'preview','insertcode']]}, function (editor) {-->
                <!--                    console.log('编辑器执行后的回调方法2')-->
                <!--                });-->
                <!--            })-->
                <!--        </script>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
        <button class="btn btn-primary">提交</button>
    </form>
    <script>
        require(['hdjs']);
        //上传图片
        function upImagePc() {
            require(['hdjs'], function (hdjs) {
                var options = {
                    multiple: false,//是否允许多图上传
                    //data是向后台服务器提交的POST数据
                    data: {name: '后盾人', year: 2099},
                };
                hdjs.image(function (images) {
                    //上传成功的图片，数组类型
                    $("[name='thumb']").val(images[0]);
                    $(".img-thumbnail").attr('src', images[0]);
                }, options)
            });
        }

        //移除图片
        function removeImg(obj) {
            $(obj).prev('img').attr('src', '/node_modules/hdjs/dist/static/image/nopic.jpg');
            $(obj).parent().prev().find('input').val('');
        }
    </script>
</block>