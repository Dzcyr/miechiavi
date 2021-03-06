<?php

namespace App\Admin\Controllers;

use App\Models\Housing;
use App\Models\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Controllers\AdminController;
use App\Enums\{HousingType, HousingHouseType, HousingToward, HousingHeating, HousingSpecial, HousingExtra, HousingLease, HousingWithdraw, HousingCost, HousingStatus, Image};

class HousingsController extends AdminController
{
    protected $title = '房源';

    protected function grid()
    {
        $grid = new Grid(new Housing());

        $grid->filter(function ($filter) {
            $filter->like('title', '标题');
            // 范围过滤器，调用模型的`onlyTrashed`方法，查询出被软删除的数据。
            $filter->scope('trashed', '回收站')->onlyTrashed();
        });

        $grid->id('ID')->sortable();
        $grid->user()->weapp_openid('所属用户')->copyable();
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
                if (!empty($v)) {
                    $arr[] = Storage::url($v);
                }
            }
            return $arr;
        })->image('', 100, 100);
        $grid->parlour_images('客厅图片')->display(function ($images) {
            $arr = [];
            foreach ($images as $v) {
                if (!empty($v)) {
                    $arr[] = Storage::url($v);
                }
            }
            return $arr;
        })->image('', 100, 100);
        $grid->kitchen_images('厨房图片')->display(function ($images) {
            $arr = [];
            foreach ($images as $v) {
                if (!empty($v)) {
                    $arr[] = Storage::url($v);
                }
            }
            return $arr;
        })->image('', 100, 100);
        $grid->toilet_images('公共卫生间图片')->display(function ($images) {
            $arr = [];
            foreach ($images as $v) {
                if (!empty($v)) {
                    $arr[] = Storage::url($v);
                }
            }
            return $arr;
        })->image('', 100, 100);
        $grid->latitude('经度');
        $grid->longitude('纬度');
        $grid->wechat('微信');
        $grid->email('邮箱');
        $grid->is_lease('出租状态')->display(function ($lease) {
            return HousingLease::getDescription($lease);
        });
        $grid->is_withdraw('下架状态')->display(function ($withdraw) {
            return HousingWithdraw::getDescription($withdraw);
        });
        $grid->begin_date('开始时间');
        $grid->end_date('结束时间');
        $grid->cost('中介费')->display(function ($cost) {
            return HousingCost::getDescription($cost);
        });
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
        $form->select('type', '租房类型')->options(HousingType::asSelectArray())->rules('required');
        $form->distpicker(['province', 'city', 'district']);
        $form->text('address', '详细地址')->rules('required');

        $form->multipleImage('bedroom_images', '卧室图片')->removable()->sortable()->move(oss_path_processing(Image::getDescription(Image::HOUSINGS_BEDROOM_IMAGES)))->uniqueName()->rules(function ($form) {
            if ((!$form->model()->id)) {
                return 'required|image';
            }
        });
        $form->multipleImage('parlour_images', '客厅图片')->removable()->sortable()->move(oss_path_processing(Image::getDescription(Image::HOUSINGS_PARLOUR_IMAGES)))->uniqueName();
        $form->multipleImage('kitchen_images', '厨房图片')->removable()->sortable()->move(oss_path_processing(Image::getDescription(Image::HOUSINGS_KITCHEN_IMAGES)))->uniqueName();
        $form->multipleImage('toilet_images', '公共卫生间图片')->removable()->sortable()->move(oss_path_processing(Image::getDescription(Image::HOUSINGS_TOILET_IMAGES)))->uniqueName();
        $form->text('wechat', '微信')->rules('required');
        $form->text('email', '邮箱')->rules('required');
        $form->select('is_lease', '出租状态')->options(HousingLease::asSelectArray())->rules('required');
        $form->select('is_withdraw', '下架状态')->options(HousingWithdraw::asSelectArray())->rules('required');
        $form->date('begin_date', '开始时间')->format('YYYY-MM-DD')->rules('required');
        $form->date('end_date', '结束时间')->format('YYYY-MM-DD')->rules('required');
        $form->select('cost', '中介费')->options(HousingCost::asSelectArray())->rules('required');
        $form->select('status', '状态')->options(HousingStatus::asSelectArray())->rules('required');
        $form->textarea('desc', '详情')->rules('required');


        $form->number('floor', '楼层');
        $form->decimal('space', '房屋面积(㎡)');
        $form->select('house_type', '户型')->options(HousingHouseType::asSelectArray());
        $form->select('toward', '朝向')->options(HousingToward::asSelectArray());
        $form->select('heating', '供暖方式')->options(HousingHeating::asSelectArray());
        $form->multipleSelect('special', '特色')->options(HousingSpecial::asSelectArray());
        $form->multipleSelect('extra', '配套设施')->options(HousingExtra::asSelectArray());
        // $form->editor('desc', '详情')->rules('required');
        // $form->multipleImage('bedroom_images', '卧室图片')->removable()->sortable()->move(oss_path_processing(Image::getDescription(Image::HOUSINGS_BEDROOM_IMAGES)))->uniqueName()->rules(function ($form) {
        //     if ((!$form->model()->id)) {
        //         return 'required|image';
        //     }
        // });
        // $form->multipleImage('parlour_images', '客厅图片')->removable()->sortable()->move(oss_path_processing(Image::getDescription(Image::HOUSINGS_PARLOUR_IMAGES)))->uniqueName()->rules(function ($form) {
        //     if ((!$form->model()->id)) {
        //         return 'required|image';
        //     }
        // });
        // $form->multipleImage('kitchen_images', '厨房图片')->removable()->sortable()->move(oss_path_processing(Image::getDescription(Image::HOUSINGS_KITCHEN_IMAGES)))->uniqueName()->rules(function ($form) {
        //     if ((!$form->model()->id)) {
        //         return 'required|image';
        //     }
        // });
        // $form->multipleImage('toilet_images', '公共卫生间图片')->removable()->sortable()->move(oss_path_processing(Image::getDescription(Image::HOUSINGS_TOILET_IMAGES)))->uniqueName()->rules(function ($form) {
        //     if ((!$form->model()->id)) {
        //         return 'required|image';
        //     }
        // });
        $form->latlong('latitude', 'longitude', '位置');
        return $form;
    }
}
