<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class MultipleChoice extends Model
{
    protected $table = 'multiple_choices';

    protected $fillable = [
        'question_id',
        'choice',
    ];
}
