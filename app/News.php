<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','title','desc','extract','area','created','media_id','date','categories','lang_id','project_id','image'
    ];

    public function language(){
        return $this->belongsTo('App\Language', 'lang_id', 'lang_id');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function media(){
        return $this->belongsTo('App\Media', 'media_id', 'media_id');
    }

    public function keyword(){
        return $this->belongsTo('App\Keyword', 'keyword_id', 'keyword_id');
    }
}
