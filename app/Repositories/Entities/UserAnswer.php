<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = 'user_answers';

    protected $fillable = [
        'user_id',
        'question_id',
        'mc_id',
    ];
}
