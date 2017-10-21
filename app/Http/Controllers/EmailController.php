<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class EmailController extends Controller
{
    public function verify($token){

        $user = User::where('confirmation_token',$token)->first();

        if (is_null($user)) {
            // 没有该记录,则重定向到首页
            return redirect('/');
        }

        $user->is_active = 1;                                   // is_active = 1,表示邮箱已激活
        $user->confirmation_token = str_random(40);     // 为了安全,需重置confirmation_token,确保为一次性的值
        $user->save();                                          // 修改并保存于数据库

        // 此处使用到Auth类，需要在头部添加 use Auth;
        // 登录该用户
        Auth::login($user);
        // 有该记录,则重定向到登录成功页面
        return redirect('/home');
    }
}
