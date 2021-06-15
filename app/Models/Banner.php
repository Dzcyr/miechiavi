<?php

namespace App\Models;

use Illuminate\Support\Str;

class Banner extends Model
{
    protected $fillable = [
        'title', 'type', 'image', 'desc', 'rank'
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
