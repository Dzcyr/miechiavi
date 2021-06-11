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
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Housing';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Housing());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('title', __('Title'));
        $grid->column('rent', __('Rent'));
        $grid->column('floor', __('Floor'));
        $grid->column('space', __('Space'));
        $grid->column('type', __('Type'));
        $grid->column('house_type', __('House type'));
        $grid->column('toward', __('Toward'));
        $grid->column('province', __('Province'));
        $grid->column('city', __('City'));
        $grid->column('district', __('District'));
        $grid->column('address', __('Address'));
        $grid->column('heating', __('Heating'));
        $grid->column('special', __('Special'));
        $grid->column('extra', __('Extra'));
        $grid->column('desc', __('Desc'));
        $grid->column('image', __('Image'));
        $grid->column('is_delete', __('Is delete'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Housing::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('title', __('Title'));
        $show->field('rent', __('Rent'));
        $show->field('floor', __('Floor'));
        $show->field('space', __('Space'));
        $show->field('type', __('Type'));
        $show->field('house_type', __('House type'));
        $show->field('toward', __('Toward'));
        $show->field('province', __('Province'));
        $show->field('city', __('City'));
        $show->field('district', __('District'));
        $show->field('address', __('Address'));
        $show->field('heating', __('Heating'));
        $show->field('special', __('Special'));
        $show->field('extra', __('Extra'));
        $show->field('desc', __('Desc'));
        $show->field('image', __('Image'));
        $show->field('is_delete', __('Is delete'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
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
