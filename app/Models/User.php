<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use DefaultDatetimeFormat;

    protected $fillable = [
        'weapp_openid', 'weixin_session_key', 'nickname', 'avatar', 'gender', 'is_delete'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
