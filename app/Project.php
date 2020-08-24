<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','name','desc'
    ];

    public function news()
    {
        return $this->hasMany('App\News');
    }
}
