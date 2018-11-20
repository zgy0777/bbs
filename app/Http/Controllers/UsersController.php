<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{

    //引入控制器中间件
    public function __construct()
    {
        $this->middleware('auth',['except' => ['show']]);
    }

    //
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request,ImageUploadHandler $uploader,User $user)
    {
        //dd($request->avatar);

        //快速授权
        $this->authorize('update', $user);

        //获取所有表单数据
        $data = $request->all();

        //上传图片
        if($request->avatar){
            //变量接收调用上传图片方法结果
            $result = $uploader->save($request->avatar,'avatars',$user->id,362);
            //判断变量，成功则将数据写入data数组（要提交的数据）
            //上传方法中定义后缀判断，不符合则返回false
            if($request){
                $data['avatar'] = $result['path'];
            }
        }


        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新');
    }
    
}
