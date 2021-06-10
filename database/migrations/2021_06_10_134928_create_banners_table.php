<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('标题');
            $table->tinyInteger('type')->unsigned()->default(1)->comment('类型 1.默认 2.通知 3.咨询');
            $table->string('image')->comment('展示图');
            $table->text('desc')->comment('详情');
            $table->integer('rank')->comment('顺序');
            $table->tinyInteger('is_delete')->unsigned()->default(0)->comment('是否删除 0.否 1.是');
            
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
        Schema::dropIfExists('banners');
    }
}
