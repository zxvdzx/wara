<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_users';

    public function User()
    {
        return $this->belongsTo('App\Repositories\Entities\RoleUser','user_id','id');
    }

    public function Role()
    {
        return $this->belongsTo('App\Repositories\Entities\Role','role_id','id');
    }
}
