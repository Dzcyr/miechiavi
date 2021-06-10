<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Housing extends Model
{
    protected $fillable = [
        'user_id', 'title', 'rent', 'floor', 'space', 'type',
        'house_type', 'toward', 'province', 'city', 'district', 'address',
        'heating', 'special', 'extra', 'desc', 'image', 'is_delete'
    ];
}
