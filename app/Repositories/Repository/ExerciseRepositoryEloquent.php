<?php

namespace App\Repositories\Repository;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ExerciseRepository;

use App\Repositories\Auth\Service\AuthRepositorySentinel as AuthRepository;
use App\Repositories\Entities\QuestionCategory;
use App\Repositories\Entities\Question;
use App\Repositories\Entities\MultipleChoice;
use App\Repositories\Entities\Answer;
use App\Repositories\Entities\UserAnswer;
use App\Repositories\Entities\UserPoint;

class ExerciseRepositoryEloquent extends BaseRepository implements ExerciseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        //
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    // /**
    //  * Repository presenter
    //  */
    // public function presenter()
    // {
    //     return 'App\\Repositories\\Presenters\\PortfolioPresenter';
    // }

	/**
	* @var $model
	*/
    
    private $categoryName   = "";
    private $categoryId     = "";
    private $category       = "";
    private $questions      = [];
    private $choices        = [];

	public function __construct(AuthRepository $auth_repository)
	{
        $this->auth_repository = $auth_repository;

        $this->category = QuestionCategory::where('is_active', true)->get()->toArray();
        if(count($this->category)>0){
            $this->categoryName = $this->category[0]['category'];
            $this->categoryId = $this->category[0]['id'];
            $this->questions = Question::where('category_id', $this->category[0]['id'])->get();
            $questionIdList = Question::where('category_id', $this->category[0]['id'])->pluck('id');
            $this->choices = MultipleChoice::whereIn('question_id', $questionIdList)->get();
        }
	}

	public function getIndex()
  	{
        try
        {   
            $categoryName = $this->categoryName;
            $questions    = $this->questions;
            $choices      = $this->choices;
            
            return view('frontend.exercise', compact('categoryName','questions','choices'));
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }
    
    public function post($attributes)
    {
        try {
            $userId = $this->auth_repository->getUserInfo('id');
            
            $questionIdList = [];
            $point = 0;
            foreach($attributes as $k => $val){
                $ans = explode('_',$k);
                if($ans[0]=='ans'){
                    $userAnswer = new UserAnswer();
                    $userAnswer->user_id = $userId;
                    $userAnswer->question_id = $ans[1];
                    $userAnswer->mc_id = $val;
                    $userAnswer->save();
                    $pointPatern = Question::where('id', $ans[1])->first()->point;
                    $answerPatern = Answer::where('question_id', $ans[1])->first()->mc_id;
                    if($answerPatern==$val){
                        $point+=$pointPatern;
                    }
                }
            }
            $userPoint = new UserPoint();
            $userPoint->user_id     = $userId;
            $userPoint->category_id = $this->categoryId;
            $userPoint->point       = $point;
            $userPoint->save();

            flash()->success('Congratulations !!!');
            
            return back();
        } 
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }

    }
}
