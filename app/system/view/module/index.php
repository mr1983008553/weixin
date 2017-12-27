<extend file='resource/view/admin/module'/>
<block name="content">
	<!-- TAB NAVIGATION -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="{{u('index')}}" >模块列表</a></li>
		<li ><a href="{{u('design')}}" >设计模块</a></li>
	</ul>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">模块列表</h3>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
				<tr>
					<th>编号</th>
					<th>模块标识</th>
					<th>模块中文名称</th>
					<th>预览图</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<foreach from="$field" key="$k" value="$v">
					<tr>
						<td>{{$k+1}}</td>
						<td>{{$v['name']}}</td>
						<td>{{$v['title']}}</td>
						<td><img src="{{$v['preview']}}" style="width: 50px" alt=""></td>
						<td>
							<div class="btn-group btn-group-xs">
								<button type="button" class="btn btn-primary" onclick="recovery('{{$v['path']}}')">还原</button>
								<button type="button" class="btn btn-danger" onclick="del('{{$v['path']}}')">删除</button>
							</div>
						</td>
					</tr>
				</foreach>
				</tbody>
			</table>
		</div>
	</div>
	<script>
        //还原
        function recovery(path) {
            require(['hdjs'], function (hdjs) {
                hdjs.confirm('确定还原数据吗?', function () {
                    location.href = "{!! u('recovery') !!}" + '&path='+path;
                })
            })
        }
        //删除
        function del(path) {
            require(['hdjs'], function (hdjs) {
                hdjs.confirm('确定删除吗?', function () {
                    location.href = "{!! u('del') !!}" + '&path='+path;
                })
            })
        }
	</script>
</block>