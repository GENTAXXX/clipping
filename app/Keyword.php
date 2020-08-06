<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','name','news_id'
    ];

    public function news()
    {
        return $this->hasMany('App\News');
    }
}
