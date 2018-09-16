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
    
    public static function getCategoryList()
    {
        return QuestionCategory::pluck('category','id')->all();
    }

    public static function changeIsActive($id)
    {
        QuestionCategory::where('id',$id)->update(['is_active' => true]);
        QuestionCategory::where('id','<>',$id)->update(['is_active' => false]);
    }
}