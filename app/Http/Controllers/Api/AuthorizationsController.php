<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\Api\WeappAuthorizationRequest;

class AuthorizationsController extends Controller
{
    // 小程序登录
    public function weappStore(WeappAuthorizationRequest $request)
    {
        $code = $request->code;

        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        if (isset($data['errcode'])) {
            return response()->json([
                'code' => 1001,
                'message' => 'code 已过期或不正确',
                'status' => 'error'
            ]);
            //return $this->failed('code 已过期或不正确', 401);
        }

        $user = User::where('weapp_openid', $data['openid'])->first();
        $attributes = [
            'weapp_openid' => $data['openid'],
            'weixin_session_key' => $data['session_key']
        ];
        // 没有用户，默认创建一个用户
        if (!$user) {
            $user = User::create($attributes);
        }else{
            // 更新用户数据
            $user->update($attributes);
        }
        // 为对应用户创建 JWT
        $token = auth('api')->login($user);
        return $this->success([
            'access_token' => 'Bearer ' . $token
        ]);
    }
}