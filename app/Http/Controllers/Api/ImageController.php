<?php

namespace App\Http\Controllers\Api;

use App\Enums\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\ImageRequest;

class ImageController extends Controller
{
    // 上传图片
    public function store(ImageRequest $request)
    {
        $path = oss_path_processing(Image::getDescription($request->type));
        $url = Storage::put($path, $request->image);
        return $this->success([
            'file_name' => $path . '/' . str_replace($path . '/', '', $url),
            'url' => Storage::url($url),
            'type' => $request->type
        ]);
    }
}
