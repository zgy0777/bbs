<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //root
    public function root()
    {
        return view('pages.root');
    }

    //权限页面
    public function permissionDenied()
    {
        //如果当前用户有权限访问则跳转
        if(config('administrator.permission')()){
            return redirect(url(config('administrator.url')),302);
        }

        //否则使用视图
        return view('pages.permission_denied');
    }

}
