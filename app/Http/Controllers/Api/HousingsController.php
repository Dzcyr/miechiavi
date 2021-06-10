<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Housing;
use App\Http\Requests\HousingRequest;
use App\Http\Resources\HousingResource;

class HousingsController extends Controller
{
    // 新增房源信息
    public function store(HousingRequest $request, Housing $housing)
    {
        $user = auth('api')->user();
        $housing->fill($request->all());
        $housing->user_id = $user->id;
        $housing->save();
        return $this->success(new HousingResource($housing));
    }
}
