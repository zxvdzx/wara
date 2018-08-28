<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    protected $table = 'user_points';

    protected $fillable = [
        'user_id',
        'category_id',
        'point',
    ];
}