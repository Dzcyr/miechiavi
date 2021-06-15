<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\IsDelete;

class CreateUserViewHousingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_view_housings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('用户ID');
            $table->unsignedBigInteger('housing_id')->comment('房源ID');
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
        Schema::dropIfExists('user_view_housings');
    }
}
