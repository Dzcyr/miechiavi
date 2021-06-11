<?php

namespace App\Http\Controllers\Api;

use App\Models\Housing;
use App\Http\Requests\Api\HousingRequest;
use App\Http\Resources\HousingResource;

class HousingsController extends Controller
{
    // 新增房源信息
    public function store(HousingRequest $request, Housing $housing)
    {
        $user = auth('api')->user();
        $housing->fill($request->all());
        
        $housing->special = json_encode($housing->special, 256);
        $housing->extra = json_encode($housing->extra, 256);
        $housing->image = json_encode($housing->image, 256);
        $housing->user_id = $user->id;
        $housing->save();
        return $this->success(new HousingResource($housing));
    }
}
