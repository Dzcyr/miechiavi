<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    const TYPE_DEFAULT = 1;
    const TYPE_NOTICE = 2;
    const TYPE_CONSULT = 3;

    public static $typeMap = [
        self::TYPE_DEFAULT   => '默认',
        self::TYPE_NOTICE => '通知',
        self::TYPE_CONSULT  => '咨询',
    ];

    protected $fillable = [
        'title', 'type', 'image', 'desc', 'rank', 'is_delete'
    ];

    public function getImageUrlAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return \Storage::disk(env('FILESYSTEM_DRIVER'))->url($this->attributes['image']);
    }
}
