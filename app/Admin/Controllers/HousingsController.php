<?php

namespace App\Admin\Controllers;

use App\Models\Housing;
use App\Models\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Controllers\AdminController;
use App\Enums\{HousingType, HousingHouseType, HousingToward, HousingHeating, HousingSpecial, HousingExtra, HousingStatus};

class HousingsController extends AdminController
{
    protected $title = '房源';

    protected function grid()
    {
        $grid = new Grid(new Housing());

        $grid->filter(function($filter){
            $filter->like('title', '标题');
            // 范围过滤器，调用模型的`onlyTrashed`方法，查询出被软删除的数据。
            $filter->scope('trashed', '回收站')->onlyTrashed();
        });
        
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
        $grid->province('省')->display(function ($province) {
            return config('position.province.' . $province);
        });
        $grid->city('市')->display(function ($city) {
            return config('position.city.' . $this->province . '.' . $city);
        });
        $grid->district('区')->display(function ($district) {
            return config('position.district.' . $this->city . '.' . $district);
        });
        $grid->address('详细地址');
        $grid->heating('供暖方式')->display(function ($heating) {
            return HousingHeating::getDescription($heating);
        });
        $grid->special('特色')->display(function ($specials) {
            $arr = [];
            foreach ($specials as $v) {
                $arr[] = HousingSpecial::getDescription($v);
            }
            return $arr;
        })->implode(',');
        $grid->extra('配套设施')->display(function ($extras) {
            $arr = [];
            foreach ($extras as $v) {
                $arr[] = HousingExtra::getDescription($v);
            }
            return $arr;
        })->implode(',');
        $grid->bedroom_images('卧室图片')->display(function ($images) {
            $arr = [];
            foreach ($images as $v) {
                $arr[] = Storage::url($v);
            }
            return $arr;
        })->image('', 100, 100);
        $grid->parlour_images('客厅图片')->display(function ($images) {
            $arr = [];
            foreach ($images as $v) {
                $arr[] = Storage::url($v);
            }
            return $arr;
        })->image('', 100, 100);
        $grid->kitchen_images('厨房图片')->display(function ($images) {
            $arr = [];
            foreach ($images as $v) {
                $arr[] = Storage::url($v);
            }
            return $arr;
        })->image('', 100, 100);
        $grid->toilet_images('公共卫生间图片')->display(function ($images) {
            $arr = [];
            foreach ($images as $v) {
                $arr[] = Storage::url($v);
            }
            return $arr;
        })->image('', 100, 100);
        $grid->status('状态')->display(function ($status) {
            return HousingStatus::getDescription($status);
        });
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
        $form->multipleImage('bedroom_images', '卧室图片')->removable()->sortable()->move('housings/bedroom_images')->uniqueName()->rules(function ($form) {
            if ((!$form->model()->id)) {
                return 'required|image';
            }
        });
        $form->multipleImage('parlour_images', '客厅图片')->removable()->sortable()->move('housings/parlour_images')->uniqueName()->rules(function ($form) {
            if ((!$form->model()->id)) {
                return 'required|image';
            }
        });
        $form->multipleImage('kitchen_images', '厨房图片')->removable()->sortable()->move('housings/kitchen_images')->uniqueName()->rules(function ($form) {
            if ((!$form->model()->id)) {
                return 'required|image';
            }
        });
        $form->multipleImage('toilet_images', '公共卫生间图片')->removable()->sortable()->move('housings/toilet_images')->uniqueName()->rules(function ($form) {
            if ((!$form->model()->id)) {
                return 'required|image';
            }
        });
        $form->select('status', '状态')->options(HousingStatus::asSelectArray())->rules('required');
        return $form;
    }
}
