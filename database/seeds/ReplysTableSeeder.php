<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Topic;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        //所有用户数组
        $user_ids = User::all()->pluck('id')->toArray();

        //所有话题的id数组，后续faker随机填充
        $topic_ids = Topic::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)
            ->times(1000)
            ->make()
            ->each(function($reply,$index) use($user_ids,$topic_ids,$faker){
                //话题用户id随机生成
                $reply->user_id =$faker->randomElement($user_ids);
                //话题id随机生成
                $reply->topic_id =$faker->randomElement($topic_ids);
            });

        Reply::insert($replys->toArray());


    }

}

