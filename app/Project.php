<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','name','year','role_id'
    ];

    public function role()
    {
        return $this->hasOne('App\Role', 'role_id', 'role_id');
    }
}
