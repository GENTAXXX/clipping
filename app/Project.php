<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'project_id';
    protected $fillable = [
        'project_id','project_name','project_year','role_id'
    ];
}
