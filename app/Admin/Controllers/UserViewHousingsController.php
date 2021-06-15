<?php

namespace App\Admin\Controllers;

use App\Models\UserViewHousing;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserViewHousingsController extends AdminController
{
    protected $title = '查看房源记录';

    protected function grid()
    {
        $grid = new Grid(new UserViewHousing());

        $grid->filter(function($filter){
            $filter->like('user.nickname', '用户昵称');
            $filter->like('housing.title', '用户昵称');
        });

        $grid->id('ID')->sortable();
        $grid->user()->nickname('用户昵称')->copyable();
        $grid->housing()->title('房源名称')->copyable();

        // 禁用创建按钮
        $grid->disableCreateButton();
        $grid->disableActions();

        return $grid;
    }
}
