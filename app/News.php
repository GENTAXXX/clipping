<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primaryKey = 'news_id';
    protected $fillable = [
        'news_id','news_title','news_desc','news_extract','news_area','news_created','media_id','news_date','categories','keywords','lang_id','project_id','image'
    ];

    public function language(){
        return $this->hasOne('App\Language', 'lang_id', 'lang_id');
    }

    public function category(){
        return $this->hasOne('App\Category');
    }

    public function media(){
        return $this->hasOne('App\Media', 'media_id', 'media_id');
    }

    public function keyword(){
        return $this->hasMany('App\Keyword', 'keyword_id', 'keyword_id');
    }
}
