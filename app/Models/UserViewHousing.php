<?php

namespace App\Models;

class UserViewHousing extends Model
{
    protected $fillable = [
        'user_id', 'housing_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function housing()
    {
        return $this->belongsTo(Housing::class);
    }
}
