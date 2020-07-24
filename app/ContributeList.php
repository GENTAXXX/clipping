<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContributeList extends Model
{
    protected $fillable = [
        'project_id','user_id','role_id'
    ];
}
