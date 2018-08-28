<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = [
        'question_id',
        'mc_id',
    ];
}
