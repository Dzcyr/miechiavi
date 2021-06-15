<?php

namespace App\Models;

class Housing extends Model
{
    protected $fillable = [
        'user_id', 'title', 'rent', 'floor', 'space', 'type',
        'house_type', 'toward', 'province', 'city', 'district',
        'address', 'heating', 'special', 'extra', 'desc',
        'bedroom_images', 'parlour_images', 'kitchen_images', 'toilet_images', 'is_delete'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 特色
    public function getSpecialAttribute($value)
    {
        return explode(',', $value);
    }
    public function setSpecialAttribute($value)
    {
        $this->attributes['special'] = implode(',', $value);
    }

    // 配套设施
    public function getExtraAttribute($value)
    {
        return explode(',', $value);
    }
    public function setExtraAttribute($value)
    {
        $this->attributes['extra'] = implode(',', $value);
    }

    // 卧室图片
    public function setBedroomImagesAttribute($images)
    {
        if (is_array($images)) {
            $this->attributes['bedroom_images'] = json_encode($images);
        }
    }
    public function getBedroomImagesAttribute($images)
    {
        return json_decode($images, true);
    }

    // 客厅图片
    public function setParlourImagesAttribute($images)
    {
        if (is_array($images)) {
            $this->attributes['parlour_images'] = json_encode($images);
        }
    }
    public function getParlourImagesAttribute($images)
    {
        return json_decode($images, true);
    }

    // 厨房图片
    public function setKitchenImagesAttribute($images)
    {
        if (is_array($images)) {
            $this->attributes['kitchen_images'] = json_encode($images);
        }
    }
    public function getKitchenImagesAttribute($images)
    {
        return json_decode($images, true);
    }

    // 公共卫生间图片
    public function setToiletImagesAttribute($images)
    {
        if (is_array($images)) {
            $this->attributes['toilet_images'] = json_encode($images);
        }
    }
    public function getToiletImagesAttribute($images)
    {
        return json_decode($images, true);
    }
}
