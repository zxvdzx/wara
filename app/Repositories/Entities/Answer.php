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

    public function setAttributesFromJson($attributes)
    {
        if(isset($attributes['question_id'])){
            $this->question_id = $attributes['question_id'];
        }
        if(isset($attributes['mc_id'])){
            $this->mc_id = $attributes['mc_id'];
        }
    }
}
