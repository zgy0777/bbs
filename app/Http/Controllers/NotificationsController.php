<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        //获取登陆用户读所有通知
        $notifications = Auth::user()->notifications()->paginate(20);
        //标记已读
        Auth::user()->markAsRead();
        return view('notifications.index',compact('notifications'));
    }

}
