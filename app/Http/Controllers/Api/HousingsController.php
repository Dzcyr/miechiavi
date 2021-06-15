<?php

namespace App\Http\Controllers\Api;

use App\Models\Housing;
use Illuminate\Http\Request;
use App\Http\Requests\Api\HousingRequest;
use App\Http\Resources\HousingResource;
use App\Enums\{HousingType, HousingHouseType, HousingToward, HousingHeating, HousingSpecial, HousingExtra};


class HousingsController extends Controller
{
    /**
     * 下拉框列表
     *
     * @Author 佟飞
     * @DateTime 2021-06-14
     * @return void
     */
    public function select()
    {
        return $this->success([
            'multiArray' => [
                $this->format(config('position.province')),
                $this->format(array_slice(config('position.city'), 0, 1)[0]),
                $this->format(array_slice(config('position.district'), 0, 1)[0])
            ],
            'region' => [
                'milan' => [
                    $this->format(array_slice(config('position.city'), 1, 1)[0]),
                    $this->format(array_slice(config('position.district'), 1, 1)[0])
                ],
                'luoma' => [
                    $this->format(array_slice(config('position.city'), 2, 1)[0]),
                    $this->format(array_slice(config('position.district'), 2, 1)[0])
                ],
            ],
            'type' => $this->format(HousingType::asSelectArray()),
            'house_type' => $this->format(HousingHouseType::asSelectArray()),
            'toward' => $this->format(HousingToward::asSelectArray()),

            'heating' => $this->format(HousingHeating::asSelectArray()),
            'special' => $this->format(HousingSpecial::asSelectArray()),
            'extra' => $this->format(HousingExtra::asSelectArray()),
        ]);
    }

    /**
     * 房源列表
     *
     * @Author 佟飞
     * @DateTime 2021-06-15
     * @param UserAddress $userAddress
     * @return void
     */
    public function index(Housing $housing)
    {
        HousingResource::wrap('data');
        $user = auth('api')->user();
        return $this->success(HousingResource::collection(
            $housing::where('user_id', $user->id)->recent()->get()
        ));
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
        $housing->user_id = $user->id;
        $housing->save();
        return $this->success(new HousingResource($housing));
    }

    /**
     * 房源详情
     *
     * @Author 佟飞
     * @DateTime 2021-06-15
     * @param Housing $housing
     * @return void
     */
    public function show(Housing $housing, Request $request)
    {
        // 添加到观看记录中
        $user = $request->user();
        if (!$user->viewHousings()->find($housing->id)) {
            $user->viewHousings()->attach($housing);
        }
        return $this->success(new HousingResource($housing));
    }

    /**
     * 收藏房源
     *
     * @Author 佟飞
     * @DateTime 2021-06-15
     * @param Housing $housing
     * @param Request $request
     * @return void
     */
    public function favor(Housing $housing, Request $request)
    {
        $user = $request->user();
        if (!$user->favoriteHousings()->find($housing->id)) {
            $user->favoriteHousings()->attach($housing);
        }
        return $this->success([]);
    }

    /**
     * 取消收藏房源
     *
     * @Author 佟飞
     * @DateTime 2021-06-15
     * @param Housing $housing
     * @param Request $request
     * @return void
     */
    public function disfavor(Housing $housing, Request $request)
    {
        $user = $request->user();
        $user->favoriteHousings()->detach($housing);

        return $this->success([]);
    }

    public function format($arr)
    {
        foreach ($arr as $k => $v) {
            $res[] = ['id' => $k, 'name' => $v];
        }
        return ($res) ?? [];
    }
}
