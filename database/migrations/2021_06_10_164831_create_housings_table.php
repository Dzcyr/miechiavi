<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\{HousingLease, HousingWithdraw, HousingStatus};

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
            $table->decimal('longitude', 10, 7)->nullable()->comment('经度');
            $table->decimal('latitude', 10, 7)->nullable()->comment('纬度');
            $table->string('wechat')->comment('微信');
            $table->string('email')->comment('邮箱');
            $table->tinyInteger('is_lease')->default(HousingLease::OFF)->comment('出租状态');
            $table->tinyInteger('is_withdraw')->default(HousingWithdraw::OFF)->comment('下架状态');
            $table->tinyInteger('status')->default(HousingStatus::DEFAULT)->comment('状态');
            $table->softDeletes();
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
