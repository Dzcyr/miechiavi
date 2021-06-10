<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    // 首页
    $router->get('/', 'HomeController@index')->name('home');

    // 用户
    $router->get('users', 'UsersController@index');

    // 轮播图
    $router->get('banners', 'BannersController@index');
    $router->get('banners/create', 'BannersController@create');
    $router->post('banners', 'BannersController@store');
    $router->get('banners/{id}/edit', 'BannersController@edit');
    $router->put('banners/{id}', 'BannersController@update');

    // 编辑器上传
    $router->post('editor/image', 'EditorController@image');
});
