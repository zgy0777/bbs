<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    //
    public function show(Category $category)
    {
        //读取分类id关联的话题，按20条每页
        $topics = Topic::where('category_id',$category->id)->paginate(20);
        //渲染视图
        return view('topics.index',compact('topics','category'));

    }
}
