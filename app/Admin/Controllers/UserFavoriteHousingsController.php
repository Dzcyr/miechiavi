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

        $grid->filter(function ($filter) {
            $filter->like('user.weapp_openid', '所属用户');
            $filter->like('housing.title', '房源名称');
        });

        $grid->id('ID')->sortable();
        $grid->user()->weapp_openid('所属用户')->copyable();
        $grid->housing()->title('房源名称')->copyable();

        // 禁用创建按钮
        $grid->disableCreateButton();
        $grid->disableActions();

        return $grid;
    }
}
