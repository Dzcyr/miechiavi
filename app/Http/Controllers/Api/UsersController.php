<?php

namespace App\Http\Controllers\Api;

use App\Models\Housing;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\UserRequest;

class UsersController extends Controller
{
    // 我的
	public function mine()
    {
        $storage = \Storage::disk(env('FILESYSTEM_DRIVER'));
        $path = 'other/mine/';

        $housingNum = $this->getHousingNum();

        return $this->success([
            // 'bg' => $storage->url($path.'bg.png'),
            'housings' => [
                ['id' => 1, 'title' => '收藏', 'type' => 'sc', 'dot' => (bool) 0, 'number' => 0],
                ['id' => 2, 'title' => '合同', 'type' => 'ht', 'dot' => (bool) 0, 'number' => 0],
                ['id' => 3, 'title' => '浏览', 'type' => 'll', 'dot' => (bool) 0, 'number' => 0],
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

    public function getHousingNum() {
        $user = auth('api')->user();
        return ($user) ? Housing::where('user_id', $user->id)->count() : 0;
    }
}
