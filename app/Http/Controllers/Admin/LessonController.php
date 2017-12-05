<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\Course;
use Validator;

class LessonController extends Controller
{
    //课时列表
	public function index(Request $request){
		if($request->isMethod('get')){
			return view('admin.lesson.index');			
		}else if($request->isMethod('post')){
			//ajax请求返回的数据
			
			//数据总数
			$count = Lesson::count();
			//取出课时数据
			
			//接受传递搜索条件
			//取出数据时 同时取出所属{课程}名称
			$datemin = $request->input('datemin');
			$datemax = $request->input('datemax');
			$title = $request->input('title');
			$filtercount = Lesson::where('lesson_name','like',"%{$title}%")->
							where(function($query) use($datemin,$datemax){
								if($datemin != ''){
									$query->where('created_at','>=',$datemin);
								}
								if($datemax != ''){
									$query->where('created_at','<=',$datemax);
								}
							})->count();
			
			//分页数据
			$offset = $request->input('start');
			$limit = $request->input('length');
			
			//排序数据
			$orderway = $request->input('order.0.dir');
			$id = $request->input('order.0.column');
			
			//获取排序字段
			$order = $request->input('columns.'.$id.'.data');
			
			
			//条件
			$data = Lesson::offset($offset)->
					orderBy($order,$orderway)->
					with(['course'=>function($c){
						$c->with('profession');
					}])->
					where('lesson_name','like',"%{$title}%")->
					where(function($query) use($datemin,$datemax){
						if($datemin != ''){
							$query->where('created_at','>=',$datemin);
						}
						if($datemax != ''){
							$query->where('created_at','<=',$datemax);
						}
					})->
					limit($limit)->
					get();
					
					//with['course'=>function($c){}]中course 是课时与课程模型建立的关系名称
					//$c是课程表里面的一条数据，也就是一个对象
					//$c->with('profession'); 中的profession 是课程与专业模型建立的关系名称
					//前面取出的 数据含有； 课时 课程 专业
			
			$info = [
			   'draw'=>$request->input('draw'),
			   'recordsTotal'=>$count,
			   'recordsFiltered'=>$filtercount,
			   'data'=>$data,
   		    ];
			return $info;
		}
	}
	
	public function status(Request $request,Lesson $lesson){
		$res = $lesson->update(['status'=>$request->input('status')]);
		if($res){
			return ['info'=>1];
		}else{
			return ['info'=>0];
		}
		
	}
	
	public function add(Request $request){
		if($request->isMethod('get')){
			//取出课时数据
			$course = Course::pluck('course_name','id');
			
			return view('admin.lesson.add',compact('course'));
		}else if($request->isMethod('post')){
			//数据验证  使用Validator类 
			$rules = [
				'lesson_name' => 'required',
				'course_id' => 'required|integer',
				'lesson_length' => 'required|min:10',
				'lesson_desc' => 'required',
			];
			$msg = [
				'lesson_name.required' => '课时名称不能为空',
				'course_id.required' => '要选择所属课程',
				'lessson_length.integer' => '所属课程不合法',
				'lessson_length.required' => '课时时长不能为空',
				'lesson_length.min' => '课时时长要大于10分钟',
				'lesson_desc.required' => '课时描述不能为空',
			];
			$validator = Validator::make($request->all(),$rules,$msg);
			if($validator->passes()){ 
				//通过验证，直接入库
				Lesson::create($request->all());
				return ['info'=>1];
			}else{
				//未通过验证，把错误提示显示到视图中
				//$validator->messages(); 通过该方法可以把错误信息 输出
				$errorinfo = collect( $validator->messages() )->implode('0',',');
				return ['info'=>0,'errorinfo'=>$errorinfo];
			}
			
		}
	}
	
	//上传视频
	public function upvideo(Request $request){
		//上传文件，操作
		$file = $request->file('Filedata');
		//上传是否成功
		if($file->isValid()){
			//上传成功，存储附件，返回附件路径
			$filename = $file->store('video'.data('Y/m/d'),'public');
			return '/storage/'.$filename;
		}
	}
	//上传图片
	public function upimg(Request $request){
		//上传文件，操作
		$file = $request->file('Filedata');
		//上传是否成功
		if($file->isValid()){
			//上传成功，存储附件，返回附件路径
			$filename = $file->store('img'.data('Y/m/d'),'public');
			return '/storage/'.$filename;
		}
	}
	
	//播放视频
	public function play(Request $request,Lesson $lesson){
		return view('admin.lesson.play', compact('lesson'));
	}
	
	//修改课时操作
	public function update(Request $request, Lesson $lesson){
		if($request->ifMethod('get')){
			//显示修改的视图
			$course = Course::pluck('oourse_name', 'id');
			return view('admin.lesson.update', compact('course', 'lesson'));
		}
	}
	
}
