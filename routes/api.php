<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorizationsController;

Route::namespace('Api')->prefix('v1')->group(function () {
    // 小程序 注册登录
    Route::post('weapp/authorizations', [AuthorizationsController::class, 'weappStore']);
});
