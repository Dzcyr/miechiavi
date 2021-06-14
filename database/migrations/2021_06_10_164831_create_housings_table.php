<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\IsDelete;

class CreateHousingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('housings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('用户ID');
            $table->string('title')->comment('标题');
            $table->decimal('rent', 10, 2)->comment('租金(€)');
            $table->integer('floor')->comment('楼层');
            $table->decimal('space', 10, 2)->comment('房屋面积(㎡)');
            $table->tinyInteger('type')->unsigned()->comment('租房类型');
            $table->tinyInteger('house_type')->unsigned()->comment('户型');
            $table->tinyInteger('toward')->unsigned()->comment('朝向');
            $table->string('province')->comment('省');
            $table->string('city')->comment('市');
            $table->string('district')->comment('区');
            $table->string('address')->comment('详细地址');
            $table->tinyInteger('heating')->unsigned()->comment('供暖方式');
            $table->string('special')->nullable()->comment('特色');
            $table->string('extra')->nullable()->comment('配套设施');
            $table->text('desc')->comment('详情');
            $table->text('bedroom_images')->comment('卧室图片');
            $table->text('parlour_images')->comment('客厅图片');
            $table->text('kitchen_images')->comment('厨房图片');
            $table->text('toilet_images')->comment('公共卫生间图片');
            $table->tinyInteger('is_delete')->unsigned()->default(IsDelete::NOT_YET)->comment('是否删除');
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
        Schema::dropIfExists('housings');
    }
}
