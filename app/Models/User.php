<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasRoles;

    use Notifiable {
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        //需要通知的是当前用户则不提示
        if($this->id == Auth::id()){
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    //消除消息已读
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //一个用户有多条回复
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }


    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function isAuthOf($model)
    {
        return $this->id == $model->user_id;
    }

    //后台密码修改
    public function setPasswordAttribute($value)
    {
        //如果值长度等于60，即认为是已做加密
        if(strlen($value)!=60){
            //不等于60做加密处理
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }

    //后台修改头像
    public function setAvatarAttribute($path)
    {
        //如果不是 http 子串开头的，那就是从后阿嚏上传的，需要补全url
        if(! starts_with($path,'http')){
            //拼接完整的url
            $path = config('app.url') . "/uploads/images/avatars/$path";
        }

        $this->attributes['avatar'] = $path;
    }
}
