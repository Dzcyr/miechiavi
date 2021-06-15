<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use SoftDeletes, DefaultDatetimeFormat;

    public function scopeRecent($query)
    {
    	// 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
}