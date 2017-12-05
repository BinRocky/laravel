<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lesson';
	protected $fillable = ['lesson_name','sourse_id','lesson_desc','cover_img','video_address','status','lesson_length','teacher_name'];
	
	//建立 课时<==>课程 关系（一对一）
	public function course(){
		return $this->hasOne('App\Course','id','course_id');
	}
}
