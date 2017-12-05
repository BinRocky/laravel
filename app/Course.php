<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
	protected $fillable = ['course_name','profession_id','course_price','course_desc','cover_img'];
	
	//定义 {课程<--->专业} 一对一的关系
	public function profession(){
		return $this->hasOne('App\Profession','id','profession_id');
	}
	
}
