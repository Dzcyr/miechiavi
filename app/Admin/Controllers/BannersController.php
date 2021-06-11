<?php

namespace App\Admin\Controllers;

use App\Models\Banner;

use App\Enums\BannerType;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;

class BannersController extends AdminController
{
    protected $title = '轮播图';

    protected function grid()
    {
        $grid = new Grid(new Banner());

        $grid->filter(function($filter){
            $filter->like('title', '标题');
        });

        $grid->model()->orderBy('rank', 'asc');

        $grid->id('ID')->sortable();
        $grid->title('标题')->editable()->copyable();
        $grid->type('类型')->display(function ($type) {
            return BannerType::getDescription($type);
        });
        $grid->image('图片')->image();
        $grid->rank('顺序')->sortable();

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Banner());
        $form->text('title', '标题')->rules('required');
        $form->select('type', '类型')->options(BannerType::asSelectArray())->rules('required');
        $form->image('image', '图片')->move('banners/images')->uniqueName()->rules('required|image');
        $form->editor('desc', '详情')->rules('required');
        $form->number('rank', '顺序')->default(0);

        return $form;
    }
}
