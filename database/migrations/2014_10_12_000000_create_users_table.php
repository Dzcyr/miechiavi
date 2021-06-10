<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('weapp_openid')->unique()->comment('OPEN ID');
            $table->string('weixin_session_key')->comment('SESSION KEY');
            $table->string('nickname')->nullable()->comment('昵称');
            $table->string('avatar')->nullable()->comment('头像');
            $table->tinyInteger('gender')->unsigned()->nullable()->comment('性别');
            $table->tinyInteger('is_delete')->unsigned()->default(0)->comment('是否删除');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
