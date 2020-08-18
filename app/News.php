<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
<<<<<<< HEAD
        'id','title','desc','content','scan','area','created','media_id','date','categories','lang_id','project_id','image'
=======
        'id','title','desc','content','area','created','media_id','date','categories','lang_id','project_id','image'
>>>>>>> 07fa5cf290d072a0b281825c395e6e8b929a238d
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
