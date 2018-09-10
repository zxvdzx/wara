<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
    protected $table = 'user_questions';

    protected $fillable = [
        'user_id',
        'question_id',
    ];
}