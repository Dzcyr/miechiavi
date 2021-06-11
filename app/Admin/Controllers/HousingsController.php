<?php

namespace App\Admin\Controllers;

use App\Models\Housing;
use App\Models\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Controllers\AdminController;

use App\Enums\{HousingType, HousingHouseType, HousingToward, HousingHeating, HousingSpecial, HousingExtra};


class HousingsController extends AdminController
{
    protected $title = '房源';

    protected function grid()
    {
        $grid = new Grid(new Housing());

        $grid->id('ID')->sortable();
        $grid->user()->nickname('所属用户')->copyable();
        $grid->title('标题')->editable()->copyable();
        $grid->rent('租金(€)')->sortable();
        $grid->floor('楼层')->sortable();
        $grid->space('房屋面积(㎡)')->sortable();
        $grid->type('租房类型')->display(function ($type) {
            return HousingType::getDescription($type);
        });
        $grid->house_type('户型')->display(function ($house_type) {
            return HousingHouseType::getDescription($house_type);
        });
        $grid->toward('朝向')->display(function ($toward) {
            return HousingToward::getDescription($toward);
        });
        $grid->province('省');
        $grid->city('市');
        $grid->district('区');
        $grid->address('详细地址');
        $grid->heating('供暖方式')->display(function ($heating) {
            return HousingHeating::getDescription($heating);
        });
        $grid->column('special', __('Special'));
        $grid->column('extra', __('Extra'));
        $grid->column('created_at', '创建时间');
        $grid->column('updated_at', '更新时间');

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Housing());

        $form->select('user_id', '选择用户')->options(User::orderBy('id', 'desc')->pluck('nickname', 'id'))->rules('required');
        $form->text('title', '标题')->rules('required');
        $form->decimal('rent', '租金(€)')->rules('required');
        $form->number('floor', '楼层')->rules('required');
        $form->decimal('space', '房屋面积(㎡)')->rules('required');
        $form->select('type', '租房类型')->options(HousingType::asSelectArray())->rules('required');
        $form->select('house_type', '户型')->options(HousingHouseType::asSelectArray())->rules('required');
        $form->select('toward', '朝向')->options(HousingToward::asSelectArray())->rules('required');
        $form->distpicker(['province', 'city', 'district']);
        $form->text('address', '详细地址')->rules('required');
        $form->select('heating', '供暖方式')->options(HousingHeating::asSelectArray())->rules('required');
        $form->multipleSelect('special', '特色')->options(HousingSpecial::asSelectArray());
        $form->multipleSelect('extra', '配套设施')->options(HousingExtra::asSelectArray());
        $form->editor('desc', '详情')->rules('required');
        $form->multipleImage('image', '图片')->move('housings/images')->uniqueName()->rules('required|image');;

        return $form;
    }
}
