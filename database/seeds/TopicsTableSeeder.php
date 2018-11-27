<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Category;
class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        //所有用户id数组 如 [1，2，3，4]
        $user_ids = User::all()->pluck('id')->toArray();

        //所有分类id数组 如 [1，2，3，4]
        $category_ids = Category::all()->pluck('id')->toArray();

        //获取faker实例
        $faker = app(Faker\Generator::class);


        $topics = factory(Topic::class)
            ->times(100)
            ->make()
            ->each(function ($topic,$index)  use($user_ids,$category_ids,$faker)
            {
                //从用户id数组随机随处一个赋值到$topic->id数组中，此处为什么一定要使用faker->randomElements,array_rand不可以吗
                $topic->user_id = $faker->randomElement($user_ids);
                //从分类id数组中随机取出一个赋值到$topic->category_id中
                $topic->category_id = $faker->randomElement($category_ids);
            });

        //模型insert插入数据是否一定要toArray()
        Topic::insert($topics->toArray());
    }

}

