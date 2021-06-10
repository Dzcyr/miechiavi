<?php

namespace App\Http\Controllers\Api;

use App\Models\Banner;
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
}
