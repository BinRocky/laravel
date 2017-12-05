<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';
	protected $fillable = ['goods_name', 'goods_price', 'cat_id', 'goods_desc', 'goods_thumb'];
	
	//配置与Category模型的关系
	public function category(){
		return $this->hasOne('App\Category', 'id', 'cat_id');
		
	}
}
