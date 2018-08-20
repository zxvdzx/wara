<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class AuthLog extends Model
{
    protected $table = 'auth_logs';

    /**
     * {@inheritDoc}
     */
    
    protected $fillable = [
        'user_id',
        'ip_address', 
        'login', 
        'logout',
    ];

    public static function getLastIdByCurrentUser($userId)
    {
    	return self::where('user_id','=', $userId)
               		->max('id');
    }
}
