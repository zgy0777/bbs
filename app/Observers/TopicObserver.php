<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;
use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        //过滤话题中的body非法标签
        $topic->body = clean($topic->body,'user_topic_body');

        $topic->excerpt = make_excerpt($topic->body);



    }

    public function saved(Topic $topic)
    {
        //如果slug没有内容，即使用翻译器对title进行翻译
        if(! $topic->slug){

            //推送任务到队列
            dispatch(new TranslateSlug($topic));

        }
    }

    public function deleted(Topic $topic)
    {
        //模型观察器调用方法时需要db构造器，不要使用orm模型
        \DB::table('replies')->where('topic_id',$topic->id)->delete();

    }


}