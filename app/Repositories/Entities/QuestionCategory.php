<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    protected $table = 'question_categories';

    protected $fillable = [
        'caregory',
    ];

    public function setAttributesFromJson($attributes)
    {
        if(isset($attributes['category'])){
            $this->category = $attributes['category'];
        }
    }
}