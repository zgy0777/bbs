<?php

function route_class(){
    return str_replace('.','-',Route::currentRouteName());
}

//辅助函数，创建话题时添加狗子，生成摘录
function make_excerpt($value,$length = 200){
    //验证规则，去掉html标签以及换行等空格
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/','',strip_tags($value)));
    //返回结果，并默认显示200位长度
    return str_limit($excerpt,$length);
}