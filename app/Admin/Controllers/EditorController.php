<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Encore\Admin\Controllers\AdminController;

class EditorController extends AdminController
{
    protected function image(Request $request)
    {
        $images = $request->file();
        if (empty($images)) {
            return $this->respondWithError(1, '请选择上传文件');
        }
        if (count($images) > 10) {
            return $this->respondWithError(2, '图片最多上传10张');
        }
        $exts = ['jpg', 'jpeg', 'png', 'gif'];
        foreach($images as $image) {
            if(!in_array($image->extension(), $exts)) {
                return $this->respondWithError(3, '请上传正确的图片类型，支持jpg/jpeg/png/gif类型');
            }
            $storage = \Storage::disk(env('FILESYSTEM_DRIVER'));
            $fileName = $storage->putFile('editor/images', $image->path());
            $data[] = $storage->url($fileName);
        }
        return response()->json([
            'errno' => 0,
            'data' => $data
        ]);
    }

    protected function respondWithError($errno, $msg)
    {
        return response()->json([
            'errno' => $errno,
            'msg' => $msg
        ]);
    }
}
