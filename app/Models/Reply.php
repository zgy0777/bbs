<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = ['content'];

    //关联话题
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
