<?php

namespace App\Http\Controllers\Api;

use App\Models\Housing;
use App\Models\UserFavoriteHousing;
use App\Models\UserViewHousing;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\HousingResource;

class UsersController extends Controller
{
    // 我的
    public function mine()
    {
        $storage = \Storage::disk(env('FILESYSTEM_DRIVER'));
        $path = 'other/mine/';

        $housingNum = $this->getHousingNum();
        $favoriteNum = $this->getFavoriteNum();
        $viewNum = $this->getViewNum();

        return $this->success([
            // 'bg' => $storage->url($path.'bg.png'),
            'housings' => [
                ['id' => 1, 'title' => '收藏', 'type' => 'sc', 'dot' => (bool) $favoriteNum, 'number' => $favoriteNum],
                ['id' => 2, 'title' => '合同', 'type' => 'ht', 'dot' => (bool) 1, 'number' => 1],
                ['id' => 3, 'title' => '浏览', 'type' => 'll', 'dot' => (bool) $viewNum, 'number' => $viewNum],
                ['id' => 4, 'title' => '房间', 'type' => 'fj', 'dot' => (bool) $housingNum, 'number' => $housingNum]
            ],
            'tools' => [
                ['id' => 1, 'title' => '使用协议', 'icon' => '', 'type' => 'syxx'],
                ['id' => 2, 'title' => '规则', 'icon' => '', 'type' => 'gz'],
                ['id' => 3, 'title' => '关于我们', 'icon' => '', 'type' => 'gywm'],
                ['id' => 4, 'title' => '客服服务', 'icon' => '', 'type' => 'khfw']
            ]
        ]);
    }

    // 更新用户信息
    public function update(UserRequest $request)
    {
        $user = auth('api')->user();

        $attributes = $request->only(['nickname', 'avatar', 'gender']);

        $user->update($attributes);

        return $this->success(new UserResource($user));
    }

    /**
     * 我的房源
     *
     * @Author 佟飞
     * @DateTime 2021-06-18
     * @param Housing $housing
     * @return void
     */
    public function housings(Housing $housing)
    {
        $user = auth('api')->user();
        return $this->success(HousingResource::collection(
            $housing->query()->where('user_id', $user->id)->recent()->paginate(10)
        ));
    }

    public function getHousingNum()
    {
        $user = auth('api')->user();
        return ($user) ? Housing::where('user_id', $user->id)->count() : 0;
    }

    public function getFavoriteNum()
    {
        $user = auth('api')->user();
        return ($user) ? UserFavoriteHousing::where('user_id', $user->id)->count() : 0;
    }

    public function getViewNum()
    {
        $user = auth('api')->user();
        return ($user) ? UserViewHousing::where('user_id', $user->id)->count() : 0;
    }
}
