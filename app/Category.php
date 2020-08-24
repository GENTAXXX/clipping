<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','name','parent'
    ];

    public function news()
    {
        return $this->hasOne('App\News_Categories');
    }
}
