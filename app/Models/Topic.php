<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body',  'category_id', 'excerpt', 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    //本地作用域
    public function scopeWithOrder($query,$order)
    {
        //不同的排序，使用不同的数据读取逻辑
        switch($order){
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }

        //N+1
        return $query->with('user','category');

    }

    public function scopeRecentReplied($query)
    {
        //当话题有新回复时，我们将编写逻辑来更新话题模型的reply_cont属性
        //此时会触发框架对数据模型 updated_at时间戳更新
        return $query->orderBy('updated_at','desc');
    }

    public function scopeRecent($query)
    {
        //按照创建时间排序
        return $query->orderBy('created_at','desc');
    }


}