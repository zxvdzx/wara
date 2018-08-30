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

    public static function getDatatables()
    {
        return Question::join('question_categories','question_categories.id','=','questions.category_id')
                        ->select('questions.id','questions.question','questions.point','questions.updated_at','question_categories.category')
                        ->get()->all();
    }

    public function setAttributesFromJson($attributes)
    {
        if(isset($attributes['category_name'])){
            $this->category_id = $attributes['category_name'];
        }
        if(isset($attributes['question'])){
            $this->question = $attributes['question'];
        }
        if(isset($attributes['point'])){
            $this->point = $attributes['point'];
        }
    }
}