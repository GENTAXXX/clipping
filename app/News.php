<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','title','desc','content','scan','area','created','media_id','date','categories','lang_id','project_id','image'
    ];

    public function language(){
        return $this->belongsTo('App\Language', 'lang_id', 'id');
    }

    public function category(){
        return $this->hasMany('App\News_Categories');
    }

    public function media(){
        return $this->belongsTo('App\Media', 'media_id', 'id');
    }

    public function keyword(){
        return $this->hasMany('App\Keyword');
    }

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }
}
