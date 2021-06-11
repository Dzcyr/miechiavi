<?php

namespace App\Http\Requests\Api;

class HousingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'rent' => 'required',
            'floor' => 'required',
            'space' => 'required',
            'type' => 'required',
            'house_type' => 'required',
            'toward' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'address' => 'required',
            'heating' => 'required',
            'special' => 'required',
            'extra' => 'required',
            'desc' => 'required',
            'image' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '标题',
            'rent' => '租金',
            'floor' => '楼层',
            'space' => '房屋面积',
            'type' => '租房类型',
            'house_type' => '户型',
            'toward' => '朝向',
            'province' => '省',
            'city' => '市',
            'district' => '区',
            'address' => '详细地址',
            'heating' => '供暖方式',
            'special' => '特色',
            'extra' => '配套设施',
            'desc' => '详情',
            'image' => '图片'
        ];
    }
}
