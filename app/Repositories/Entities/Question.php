<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'caregory_id',
        'question',
        'file_path',
        'is_file',
        'point',
    ];
}
