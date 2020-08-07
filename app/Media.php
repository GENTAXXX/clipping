<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'medias';
    protected $fillable = [
        'id','name','proviences_id','regencies_id'
    ];

    public function news()
    {
        return $this->hasOne('App\News');
    }
}
