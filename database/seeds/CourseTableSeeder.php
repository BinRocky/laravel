<?php

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course')->insert([
			[
				'course_name'=>'PHP面向对象',
				'profession_id'=>1,
				'course_desc'=>'告诉你如何搞定对象',
				'course_price'=>1231.34,
			],
			[
				'course_name'=>'javascript高级编程',
				'profession_id'=>2,
				'course_desc'=>'告诉你快速搞定js',
				'course_price'=>1231.34,
			],
			[
				'course_name'=>'jquery',
				'profession_id'=>3,
				'course_desc'=>'牛X前端开端给你加',
				'course_price'=>1231.34,
			],
			[
				'course_name'=>'Python',
				'profession_id'=>4,
				'course_desc'=>'爬虫',
				'course_price'=>1231.34,
			],
		
		]);
    }
}
