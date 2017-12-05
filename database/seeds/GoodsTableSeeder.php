<?php

use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods')->insert([
			[
				'goods_name'=>'iphone手机',
				'cat_id'=>1,
				'goods_desc'=>'乔布斯',
			],
			[
				'goods_name'=>'华为笔记本',
				'cat_id'=>2,
				'goods_desc'=>'任正非',
			],					
			[
				'goods_name'=>'阿里巴巴',
				'cat_id'=>3,
				'goods_desc'=>'马云',
			]
		]);
    }
	
	
	
	
	
	
}
