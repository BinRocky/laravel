<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
			$table->string('goods_name')->notNull()->unique()->comment('商品名称');
			$table->integer('cat_id')->notNull()->comment('所属栏目id');
			$table->string('goods_thumb',100)->notNull()->default('')->comment('商品缩略图');
			$table->decimal('goods_price',9,2)->notNull()->default(0)->comment('商品的价格');
			$table->string('goods_desc')->notNull()->default('')->comment('商品的描述');
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
        Schema::dropIfExists('goods');
    }
	
	
	
	
	
}
