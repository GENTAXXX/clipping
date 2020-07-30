<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','news_status','news_approval','news_approval_date','news_id','user_id'
    ];

    public function news()
    {
        return $this->hasOne('App\News', 'news_id', 'news_id');
    }

    public function users()
    {
        return $this->hasOne('App\User', 'user_id', 'user_id');
    }


}