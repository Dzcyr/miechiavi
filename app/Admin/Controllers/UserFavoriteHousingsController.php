<?php

namespace App\Admin\Controllers;

use App\Models\UserFavoriteHousing;

use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;

class UserFavoriteHousingsController extends AdminController
{
    protected $title = '收藏房源';

    protected function grid()
    {
        $grid = new Grid(new UserFavoriteHousing());

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
