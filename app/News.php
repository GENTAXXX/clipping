<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primaryKey = 'news_id';
    protected $fillable = [
        'news_id','news_title','news_desc','news_extract','news_status','news_area','news_approval','news_approval_date','news_created',
        'media_id','news_date','categories','keywords','lang_id','verificator_id','creator_id','project_id','image'
    ];

    public function language(){
        return $this->hasOne('App\Language', 'lang_id', 'lang_id');
    }

    public function categorie(){
        return $this->hasOne('App\Category');
    }

    public function media(){
        return $this->hasOne('App\Media', 'media_id', 'media_id');
    }

    public function keyword(){
        return $this->hasMany('App\Keyword');
    }
}
