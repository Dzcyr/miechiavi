<?php

namespace App\Http\Controllers\Api;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Resources\BannerResource;

class BannersController extends Controller
{
    public function index(Banner $banner)
    {
        BannerResource::wrap('data');
        return $this->success(BannerResource::collection(
            $banner::orderBy('rank', 'asc')->get()
        ));
    }

    public function show(Banner $banner, Request $request)
    {
        $banner = $banner->find($request->id);
        return $this->success(!empty($banner) ? new BannerResource($banner) : []);
    }
}
