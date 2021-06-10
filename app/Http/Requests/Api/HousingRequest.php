<?php

namespace App\Http\Requests\Api;

class HousingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string',
        ];
    }
}
