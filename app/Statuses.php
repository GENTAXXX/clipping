<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','status','news_id','user_id'
    ];

    public function news()
    {
        return $this->belongsTo('App\News', 'news_id', 'news_id');
    }

    public function users()
    {
        return $this->hasOne('App\User', 'user_id', 'user_id');
    }


}
