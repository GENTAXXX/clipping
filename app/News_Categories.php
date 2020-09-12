<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News_Categories extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'news_categories';
    protected $fillable = [
        'id', 'cat_id', 'news_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function news()
    {
        return $this->belongsTo('App\News');
    }
}
