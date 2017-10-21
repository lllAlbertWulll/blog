<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Naux\Mail\SendCloudTemplate;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // 获取用户填写的数据来填充数据库
        $user = User::create([
            'name' => $data['name'],                            // 用户名
            'email' => $data['email'],                          // 用户邮箱
            'avatar' => '/images/avatars/default.png',          // 用户头像
            'confirmation_token' => str_random(40),
            'password' => bcrypt($data['password']),            // 用户密码
        ]);

        $this->sendVerifyEmailTo($user);
        return $user;
    }

    private function sendVerifyEmailTo($user)
    {
        // 模板变量,在我们的模板中只用了'url' 和 'name' 两个变量
        $data = [
            // url 指向 EmailController 控制器中的 verify 方法,并传入 $user->confirmation_token
            'url' => route('email.verify',['token' => $user->confirmation_token]),      // 用户激活邮箱的url
            'name' => $user->name,                                                            // 用户名
        ];
        // 把 $data 中数据放到指定的 web_register 模板中 (模板可以在 SendCloud 官网上建立)
        $template = new SendCloudTemplate('web_register', $data);

        Mail::raw($template, function ($message) use ($user) {
            // 指定发送人的邮箱和名字
            $message->from(env('GEGEWV_EMAIL'), env('APP_NAME'));
            // 指定收件人的邮箱, 这里直接把用户填写的邮箱作为参数
            $message->to($user->email);
        });
    }
}
