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

    public function setAttributesFromJson($attributes)
    {
        if(isset($attributes['question_id'])){
            $this->question_id = $attributes['question_id'];
        }
        if(isset($attributes['choice'])){
            $this->choice = $attributes['choice'];
        }
    }
}
