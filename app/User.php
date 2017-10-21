<?php

namespace App;

use Mail;
use Naux\Mail\SendCloudTemplate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'confirmation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 重写重置密码方法
    public function sendPasswordResetNotification($token) {
        // 模板变量
        $data = [
            'url' => url('password/reset',$token),      // 重置密码链接
        ];
        // 把 $data 中数据放到指定的 web_password_reset 模板
        $template = new SendCloudTemplate('web_password_reset', $data);

        Mail::raw($template, function ($message) {
            // 指定发送人的邮箱和名字
            $message->from(env('GEGEWV_EMAIL'), env('APP_NAME'));
            // 指定收件人的邮箱, 这里直接把用户填写的邮箱作为参数
            $message->to($this->email);
        });
    }
}
