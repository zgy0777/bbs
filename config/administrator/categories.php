<?php

use App\Models\Category;

return [
    'title' => '分类',
    'single' => '分类',
    'model' => Category::class,

    //权限
    'action_permission' => [
        'delete' => function () {
            return Auth::user()->hasRole('Founder');
        }
    ],

    //数据表格
    'columns' => [
        'id' => [
            'title' => 'ID'
        ],
        'name' => [
            'title' => '名称',
            'sortable' => false,
        ],
        'description' => [
            'title' => '描述',
            'sortable' => false,
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],
    //数据表单
    'edit_fields' => [
        'name' => [
            'title' => '名称',
        ],
        'description' => [
            'title' => '描述',
            'type' => 'textarea'
        ],
    ],
    //过滤器设置
    'filters' => [
        'id' => [
            'title' => '分类 ID',
        ],
        'name' => [
            'title' => '名称',
        ],
        'description' => [
            'title' => '描述',
        ]
    ],
    //表单规则
    'roles' => [
        'name' => 'required|min:1|unique:categories'
    ],
    //错误信息反馈
    'messages' => [
        'name.required' => '分类名称必须填写',
        'name.unique' => '分类名称已被占用',
    ]
];