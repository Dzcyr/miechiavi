<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UsersController extends AdminController
{
    protected $title = '用户';

    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->filter(function($filter){
            $filter->like('weapp_openid', 'OPENID');
            // 范围过滤器，调用模型的`onlyTrashed`方法，查询出被软删除的数据。
            $filter->scope('trashed', '回收站')->onlyTrashed();
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
