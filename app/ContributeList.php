<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContributeList extends Model
{
    protected $fillable = [
        'project_id','user_id','role_id'
    ];

    public function language()
    {
        return $this->hasOne('App\Language', 'lang_id', 'lang_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'user_id', 'user_id');
    }

    public function project()
    {
        return $this->hasOne('App\Project', 'project_id', 'project_id');
    }
}
