<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKechengTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profession', function (Blueprint $table) {
            $table->increments('id');
			$table->string('profession_name',32)->notNull()->unique()->comment('专业名称');
			$table->string('profession_desc')->notNull()->comment('专业介绍');
			$table->string('cover_img',100)->notNull()->default('')->comment('专业封面图');
            $table->timestamps();
        });
		Schema::create('course', function (Blueprint $table) {
            $table->increments('id');
			$table->string('course_name',32)->notNull()->comment('课程名称');
			$table->integer('profession_id')->notNull()->comment('所属专业id');
			$table->integer('course_price')->notNull()->comment('课程价格');
			$table->string('course_desc')->notNull()->comment('课程介绍');
			$table->string('cover_img',100)->notNull()->default('')->comment('课程封面图');
            $table->timestamps();
        });
		Schema::create('lesson', function (Blueprint $table) {
            $table->increments('id');
			$table->string('lesson_name',64)->notNull()->comment('课时名称');
			$table->integer('course_id')->notNull()->comment('所属课程id');
			$table->string('lesson_desc')->notNull()->comment('课时介绍');
			$table->string('lesson_length')->notNull()->comment('课时长度');
			$table->string('cover_img',100)->notNull()->default('')->comment('课时封面图');
			$table->string('video_address',100)->notNull()->default('')->comment('课程视频地址');
			$table->string('teacher_name',32)->notNull()->default('')->comment('讲师名称');
			$table->tinyInteger('status')->notNull()->default(1)->comment('课时状态，1表示启用');
            $table->timestamps();
        });
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profession');
    }
}
