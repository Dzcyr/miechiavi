<?php

namespace App\Http\Requests\Api;

class UserRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'POST':
            case 'PUT': {
                $rules = [
                    'nickname' => 'required|string',
                    'avatar'=> 'required|string',
                    'gender' => 'required'
                ];
            }
            case 'PATCH':
            case 'DELETE':
            default: {
                $rules =  [];
            }
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'nickname' => '昵称',
            'avatar' => '头像',
            'gender' => '性别'
        ];
    }
}
