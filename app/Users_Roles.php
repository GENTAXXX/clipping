<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_Roles extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'project_id', 'user_id', 'role_id'
    ];

    public function role()
    {
        return $this->hasOne('App\Role');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function project()
    {
        return $this->hasOne('App\Project');
    }
}
