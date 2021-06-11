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

    public function getSpecialAttribute($value)
    {
        return explode(',', $value);
    }

    public function setSpecialAttribute($value)
    {
        $this->attributes['special'] = implode(',', $value);
    }

    public function getExtraAttribute($value)
    {
        return explode(',', $value);
    }

    public function setExtraAttribute($value)
    {
        $this->attributes['extra'] = implode(',', $value);
    }
}
