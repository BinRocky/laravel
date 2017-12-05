<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="{{asset('admin')}}/lib/html5shiv.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admin')}}/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admin')}}/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admin')}}/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admin')}}/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admin')}}/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="{{asset('admin')}}/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入课时名称 或 课时关键字" id="title" name="">
		<button type="submit" class="btn btn-success radius" id="searchLesson" name=""><i class="Hui-iconfont">&#xe665;</i> 搜课时</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	<span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
	<i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
	<a href="javascript:;" onclick="lesson_add()" class="btn btn-primary radius">
	<i class="Hui-iconfont">&#xe600;</i> 添加课时</a></span> 
	<span class="r">共有数据：<strong>88</strong> 条</span> </div>
	<div class="mt-20">
	
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">课时名称</th>
				<th width="40">所属课程</th>
				<th width="90">专业名称</th>
				<th width="150">封面图</th>
				<th width="">播放视频</th>
				<th width="130">添加时间</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admin')}}/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="{{asset('admin')}}/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="{{asset('admin')}}/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin')}}/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="{{asset('admin')}}/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="{{asset('admin')}}/lib/laypage/1.2/laypage.js"></script>


<script type="text/javascript">
//自定义 js方法
$(function(){
	table = $('.table-sort').dataTable({
		"lengthMenu":[2,5],
		"paging":true,
		"info":true,
		"searching":false,
		"ordering":true,
		"order":[[1,'asc']],
		"stateSave":false,
		"columnDefs":[{
			"targets":[0,5,9],
			"orderable":false
		}],
		"processing":true,
		"serverSide":true, //开启服务端响应
		"ajax":{
			"url":"{{url('admin/lesson/index')}}",
			"type":"POST",
			
			//新的 搜索 数据
			'data':function(data){
				data.title = $("#title").val();
				data.datemin = $("#datemin").val();
				data.datemax = $("#datemax").val();
			},
			 
			"headers":{ 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
		},
		"columns":[
			{'data':'a', "defaultContent":""},
			{'data':'id'},
			{'data':'lesson_name'},
			{'data':'course.course_name'},
			{'data':'course.profession.profession_name'},
			{'data':'c', "defaultContent":""},
			{'data':'c', "defaultContent":""},
			{'data':'created_at'},
			{'data':'status'},
			{'data':'b', "defaultContent":""},
		],
		
		"createdRow":function(row,data,dataindex){
			$(row).addClass('text-c');
			$(row).find('td:eq(0)').html('<input type="checkbox" value="'+data.id+'" name="ids[]" >');
			var str = '';
			if(data.status==1){
				$(row).find("td:eq(8)").html('<span class="label label-success radius">已启用</span>');
				str = '<a style="text-decoration:none" onClick="lesson_stop(this,'+data.id+')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>';
			}else {
				$(row).find("td:eq(8)").html('<span class="label radius">已停用</span>');
				str = '<a style="text-decoration:none" onClick="lesson_start(this,'+data.id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>';
			}
			$(row).find('td:eq(9)').html(str+'<a title="编辑" href="javascript:;" onclick="lesson_edit('+data.id+')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_del()" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>');
		
			var buttons = '<input onClick="play('+data.id+')" class="btn btn-success-outline radius" type="button" value="播放">';
			$(row).find("td:eq(6)").html(buttons);
		
			var imgs = '<img width="100" src="'+data.cover_img+'" />';
			$(row).find("td:eq(5)").html(imgs);
		}
	}); 
	//搜索课时
	$('#searchLesson').click(function(){
		//传递 新的时间条件，从新请求ajax 数据到后台
		table.api().ajax.reload();
		
	}); 
});

//播放视频的函数
function play(id){
	//开启一个新层播放
	layer_show('播放视频','{{url("admin/lesson/play")}}/'+id,780);
}


/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
				$(obj).remove();
				layer.msg('已启用!',{icon: 6,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
</script> 


<script type="text/javascript">
//自定义 方法
//停用
function lesson_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{url("admin/lesson/status")}}/'+id,
			dataType: 'json',
			data:{'status':0, '_token':'{{csrf_token()}}'},
			success: function(msg){
				if(msg.info==1){
					//表示停用成功 状态改成已停用
					$(obj).parents('tr').find('td:eq(8)').html('<span class="label radius">已停用</span>');
					//在自己前面添加 如下内容
					$(obj).before('<a style="text-decoration:none" onClick="lesson_start(this,'+id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>');
					//把自己删除
					$(obj).remove();
					layer.msg('停用成功',{icon:5,time:3000});
				}
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

//启用
function lesson_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{url("admin/lesson/status")}}/'+id,
			dataType: 'json',
			data:{'status':1, '_token':'{{csrf_token()}}'},
			success: function(msg){
				if(msg.info==1){
					//表示停用成功 状态改成已启用
					$(obj).parents('tr').find('td:eq(8)').html('<span class="label label-success radius">已启用</span>');
					//在自己前面添加 如下内容
					$(obj).before('<a style="text-decoration:none" onClick="lesson_stop(this,'+id+')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
					//把自己删除
					$(obj).remove();
					layer.msg('启用成功',{icon:6,time:3000});
				}
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

//添加课时
function lesson_add(){
	layer_show('添加课时','{{url("admin/lesson/add")}}');
}

//修改课时
function lesson_edit(id){
	layer_show('修改课时','{{url("admin/lesson/update")}}/'+id);
}






</script>








</body>
</html>