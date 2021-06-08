<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    public function authorize()
    {
        // false 代表权限验证不通过,返回403错误
        // true  代表权限认证通过
        return true;
    }
}
