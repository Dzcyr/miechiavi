<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;

class UsersController extends AdminController
{
    protected $title = '用户';

    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->filter(function($filter){
            $filter->like('weapp_openid', 'OPENID');
        });

        $grid->id('ID');
        $grid->weapp_openid('OPENID')->copyable();
        $grid->nickname('昵称')->copyable();
        $grid->avatar('头像')->image();
        $grid->created_at('注册时间');

        // 禁用创建按钮
        $grid->disableCreateButton();
        $grid->disableActions();

        return $grid;
    }
}
