<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $primaryKey = 'keyword_id';
    protected $fillable = [
        'keyword_id','keyword_name'
    ];
}
