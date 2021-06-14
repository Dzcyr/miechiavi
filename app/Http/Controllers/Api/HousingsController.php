<?php

namespace App\Http\Controllers\Api;

use App\Models\Housing;
use App\Http\Requests\Api\HousingRequest;
use App\Http\Resources\HousingResource;
use App\Enums\{HousingType, HousingHouseType, HousingToward, HousingHeating, HousingSpecial, HousingExtra};

class HousingsController extends Controller
{
    /**
     * 下拉框条件
     *
     * @Author 佟飞
     * @DateTime 2021-06-14
     * @return void
     */
    public function select()
    {
        return $this->success([
            'type' => HousingType::asSelectArray(),
            'house_type' => HousingHouseType::asSelectArray(),
            'toward' => HousingToward::asSelectArray(),
            'province' => config('position.province'),
            'city' => config('position.city'),
            'district' => config('position.district'),
            'heating' => HousingHeating::asSelectArray(),
            'special' => HousingSpecial::asSelectArray(),
            'extra' => HousingExtra::asSelectArray(),
        ]);
    }

    /**
     * 新增房源信息
     *
     * @Author 佟飞
     * @DateTime 2021-06-14
     * @param HousingRequest $request
     * @param Housing $housing
     * @return void
     */
    public function store(HousingRequest $request, Housing $housing)
    {
        $user = auth('api')->user();
        $housing->fill($request->all());
        $housing->bedroom_images = json_encode($housing->bedroom_images, 256);
        $housing->parlour_images = json_encode($housing->parlour_images, 256);
        $housing->kitchen_images = json_encode($housing->kitchen_images, 256);
        $housing->toilet_images = json_encode($housing->toilet_images, 256);
        $housing->user_id = $user->id;
        $housing->save();
        return $this->success(new HousingResource($housing));
    }
}
