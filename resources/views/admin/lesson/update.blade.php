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

<!--上传的代码-->
<script type="text/javascript" src="{{asset('admin')}}/lib/jquery/1.9.1/jquery.min.js"></script> 
<link rel="stylesheet" type="text/css" href="/admin/uploadify/uploadify.css">
<script src="/admin/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>


<!--[if IE 6]>
<script type="text/javascript" src="{{asset('admin')}}/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加管理员 - 管理员管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课时名称；</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="lesson_name" name="lesson_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">所属课程：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="course_id" size="1">
				<option value="">选择课程</option>
				@foreach($course as $k=>$v)
					@if($lesson->course_id == $k)
						<option selected="selected" value="{{$k}}">{{$v}}</option>
					@else
						<option value="{{$k}}">{{$v}}</option>
					@endif
				@endforeach
			</select>
			</span> 
		</div>
	</div>
	
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上传图片：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="hidden" value="{{$lesson->cover_img}}" class="input-text upload-url" id="cover_img" name="cover_img" value="">
			<input id="file_upload_img" name="file_upload" type="file" multiple="true">
		</div>
	</div>
	
	
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上传视频：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="hidden" value="{{$lesson->video_address}}" class="input-text upload-url" id="video_address" name="video_address" value="">
			<input id="file_upload_video" name="file_upload" type="file" multiple="true">
		</div>
	</div>
	
	
	
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课时时常：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$lesson->lesson_length}}" placeholder="" id="lesson_length" name="lesson_length">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>主讲老师：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" value="{{$lesson->teacher_name}}" class="input-text" placeholder="" name="teacher_name" id="teacher_name">
		</div>
	</div>
	 
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">课时描述：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="desc" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="$.Huitextarealength(this,100)">{{$lesson_desc}}</textarea>
			<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="{{asset('admin')}}/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset('admin')}}/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="{{asset('admin')}}/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin')}}/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="{{asset('admin')}}/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="{{asset('admin')}}/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
	//视频上传
	$("#file_upload_video").uploadify({
		'formData':{
			'_token' : '{{csrf_token()}}',
		},
		'swf':'/admin/uploadify/uploadify.swf',
		'uploader':'{{url("admin/lesson/upvideo")}}',
		'onUploadSuccess': function(file,data,response){
			$('#video_address').val(data);
		}
	});
		
	//图片上传
	$("#file_upload_img").uploadify({
		'formData':{
			'_token' : '{{csrf_token()}}',
		},
		'swf':'/admin/uploadify/uploadify.swf',
		'uploader':'{{url("admin/lesson/upimg")}}',
		'onUploadSuccess': function(file,data,response){
			$('#cover_img').val(data);
		}
	});
	
	
	
	//表单提交
	$('#form-admin-add').submit(function(e){
		e.preventDefault();//阻止表单提交
		var data = $(this).serialize(); //获取表单提交所有数据

		$.ajax({
			type: 'post',
			url: "{{url('admin/lesson/add')}}",
			data: data,
			dataType: 'json',
			success:function(msg){
				//返回json格式
				if(msg.info==1){
					layer.alert('添加成功',function(){
						//重新刷新datatable插件
						parent.table.api().ajax.reload();
						//关闭弹窗效果
						layer_close();
					});
				}else{
					layer.msg('添加失败：'+msg.errorinfo,{icon:5,time:5000});
				}
			}
		});
	});    
	
	
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	// $("#form-admin-add").validate({
		// rules:{
			// adminName:{
				// required:true,
				// minlength:4,
				// maxlength:16
			// },
			// password:{
				// required:true,
			// },
			// password2:{
				// required:true,
				// equalTo: "#password"
			// },
			// sex:{
				// required:true,
			// },
			// phone:{
				// required:true,
				// isPhone:true,
			// },
			// email:{
				// required:true,
				// email:true,
			// },
			// adminRole:{
				// required:true,
			// },
		// },
		// onkeyup:false,
		// focusCleanup:true,
		// success:"valid",
		// submitHandler:function(form){
			// $(form).ajaxSubmit({
				// type: 'post',
				// url: "xxxxxxx" ,
				// success: function(data){
					// layer.msg('添加成功!',{icon:1,time:1000});
				// },
                // error: function(XmlHttpRequest, textStatus, errorThrown){
					// layer.msg('error!',{icon:1,time:1000});
				// }
			// });
			// var index = parent.layer.getFrameIndex(window.name);
			// parent.$('.btn-refresh').click();
			// parent.layer.close(index);
		// }
	// });
});




</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>