<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $primaryKey = 'lang_id';
    protected $fillable = [
        'lang_id','lang_name','lang_code'
    ];
}
