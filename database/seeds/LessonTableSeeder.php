<?php

use Illuminate\Database\Seeder;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //填充Lesson表数据
		DB::table('lesson')->insert([
			[
				'lesson_name'=>'PHP变量',
				'course_id'=>1,
				'lesson_desc'=>'PHP变量最便捷',
				'lesson_length'=>'20'
			],
			[
				'lesson_name'=>'PHP数组',
				'course_id'=>1,
				'lesson_desc'=>'PHP通俗易懂',
				'lesson_length'=>'30'
			],
			[
				'lesson_name'=>'linux环境安装',
				'course_id'=>2,
				'lesson_desc'=>'搭建非常666',
				'lesson_length'=>'40'
			],			
			[
				'lesson_name'=>'cp命令讲解',
				'course_id'=>2,
				'lesson_desc'=>'讲解语法',
				'lesson_length'=>'10'
			],
			[
				'lesson_name'=>'jquery的安装',
				'course_id'=>3,
				'lesson_desc'=>'绚丽多姿的前端框架',
				'lesson_length'=>'40'
			],
			[
				'lesson_name'=>'jquery插件使用',
				'course_id'=>3,
				'lesson_desc'=>'你就比的插件',
				'lesson_length'=>'20'
			],
			
		]);
    }
}
