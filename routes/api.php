<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthorizationsController;
use App\Http\Controllers\Api\BannersController;
use App\Http\Controllers\Api\HousingsController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ArticlesController;
use App\Http\Controllers\Api\UsersController;

Route::prefix('v1')->group(function () {
    //Route::middleware('throttle:' . config('api.rate_limits.sign'))->group(function () {
    // 小程序 注册登录
    Route::post('weapp/authorizations', [AuthorizationsController::class, 'weappStore']);
    //});
    
    Route::middleware('throttle:' . config('api.rate_limits.access'))->group(function () {
        // 登录后可以访问的接口
        Route::middleware('api.refresh')->group(function () {
            // 更新用户信息
            Route::put('user', [UsersController::class, 'update']);
            // 房源下拉框列表
            Route::get('housings/select', [HousingsController::class, 'select']);
            // 收藏房源
            Route::post('housings/{housing}/favorite', [HousingsController::class, 'favor']);
            Route::delete('housings/{housing}/favorite', [HousingsController::class, 'disfavor']);
            // 房源
            Route::apiResource('housings', HousingsController::class);
            
            // 上传图片
            Route::post('images', [ImageController::class, 'store']);
        });
        // 我的
        Route::get('mine', [UsersController::class, 'mine']);
        // 轮播图
        Route::get('banners', [BannersController::class, 'index']);
        // 文章
        Route::get('articles/{article}', [ArticlesController::class, 'show']);
    });
});
