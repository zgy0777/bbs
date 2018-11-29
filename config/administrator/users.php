<?php

use App\Models\User;

return [

    //页面名称
    'title' => '用户',

    //模型页？？菜单栏？ 右侧按钮
    'single' => '用户',

    //需要操作的模型
    'model' => User::class,

    //权限访问
    'permission' => function () {
        return Auth::user()->can('manage_users');
    },

    //数据列表，取出数据库字段按需展示
    'columns' => [
        //id
        'id',
        //头像
        'avatar' => [
            'title' => '头像',
            'output' => function($avatar,$model){
                return empty($avatar) ? "N/A"  : '<img src="'.$avatar.'" width="40" >';
            },
            'sortable' => false,
        ],
        //用户名
        'name' => [
            'title' => '用户名',
            'output' => function($name,$model){
                return '<a href="/users/'.$model->id.'" target="_blank" >'.$name.'</a>';
            },
            'sortable' => false,
        ],
        //邮箱
        'email' => [
            'title' => '邮箱',
            'sortable' => false,
        ],
        //右侧管理部分
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ]
    ],
    //数据表单操作部分
    'edit_fields' => [

        'name' => [
            'title' => '用户名'
        ],
        //邮箱
        'email' => [
            'title' => '邮箱',
        ],
        //密码
        'password' => [
            'title' => '密码',
            //input标签类型
            'type' => 'password'
        ],
        //头像部分
        'avatar' => [
            'title' => '头像',
            //input标签类型
            'type' => 'image',
            //上传文件路径，基于已创建的头像保存路径下
            'location' => public_path() . '/uploads/images/avatars/'
        ],
        //角色关联部分
        'roles' => [
            'title' => '用户角色',
            //类型（此处填写关联）
            'type' => 'relationship',
            //类型名称
            'name_field' => 'name',
        ],

    ],
    //过滤器部分
    'filters' => [
        'id' => [
            'title' => '用户id',
        ],
        //用户名
        'name' => [
            'title' => '用户名',
        ],
        //邮箱
        'email' => [
            'title' => '邮箱',
        ],
    ],


];