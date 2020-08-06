<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','name','code'
    ];

    public function news(){
        return $this->hasOne('App\news');
    }
}
