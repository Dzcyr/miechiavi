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
            'type' => $this->format(HousingType::asSelectArray()),
            'house_type' => $this->format(HousingHouseType::asSelectArray()),
            'toward' => $this->format(HousingToward::asSelectArray()),
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
    public function index(Request $request, Housing $housing)
    {
        $query = $housing->query();
        // 状态
        if ($status = $request->status) {
            $query->where('status', $status);
        }
        // 租房类型
        if ($type = $request->type) {
            $query->where('type', $type);
        }
        // 省
        if ($province = $request->province) {
            $query->where('province', $province);
        }
        // 市
        if ($city = $request->city) {
            $query->where('city', $city);
        }
        // 区
        if ($district = $request->district) {
            $query->where('district', $district);
        }
        // 房源面积(㎡)
        if ($space = $request->space) {
            $query->whereBetween('space', [$space[0], $space[1]]);
        }
        // 房源价格
        if ($rent = $request->rent) {
            $query->whereBetween('rent', [$rent[0], $rent[1]]);
        }
        // 户型
        if ($house_type = $request->house_type) {
            $query->where('house_type', $house_type);
        }
        // 供暖方式
        if ($heating = $request->heating) {
            $query->where('heating', $heating);
        }
        return $this->success(HousingResource::collection(
            $query->recent()->paginate(10)
        ));
    }

    /**
     * 搜索
     *
     * @Author 佟飞
     * @DateTime 2021-06-26
     * @param Request $request
     * @param Housing $housing
     * @return void
     */
    public function search(Request $request, Housing $housing)
    {
        $builder = $housing->query();
        if ($search = $request->search) {
            $builder->where(function ($query) use ($search) {
                $extras = HousingExtra::asSelectArray();
                $extra = array_search($search, $extras);
                if ($extra) {
                    $query->orWhereRaw('FIND_IN_SET(' . $extra . ',`extra`)');
                }
                $specials = HousingSpecial::asSelectArray();
                $special = array_search($search, $specials);
                if ($special) {
                    $query->orWhereRaw('FIND_IN_SET(' . $special . ',`special`)');
                }
            });
        }
        return $this->success(HousingResource::collection(
            $builder->recent()->paginate(10)
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
        $user = $request->user();
        $housing = $housing->find($request->id);
        if (!empty($housing)) {
            // 添加到观看记录中
            if (!$user->viewHousings()->find($request->id)) {
                $user->viewHousings()->attach($housing);
            }
            return $this->success((new HousingResource($housing))->showInfoFields());
        }
        return $this->success([]);
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
        $housing = $housing->find($request->id);
        if (!empty($housing)) {
            if (!$user->favoriteHousings()->find($housing->id)) {
                $user->favoriteHousings()->attach($housing);
            }
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
        $housing = $housing->find($request->id);
        if (!empty($housing)) {
            $user->favoriteHousings()->detach($housing);
        }
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
