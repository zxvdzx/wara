<?php

namespace App\Repositories\Repository;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\AdminQuestionRepository;

use App\Repositories\Entities\Question;
use App\Repositories\Entities\MultipleChoice;
use App\Repositories\Entities\QuestionCategory;
use App\Repositories\Entities\Answer;

use DB;

/**
 * Class AdminQuestionRepositoryEloquent
 * @package namespace App\Repositories\Repository;
 */
class AdminQuestionRepositoryEloquent extends BaseRepository implements AdminQuestionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Question::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * index page.
     *
     * @return mixed
     */
    public function getIndex()
    {
        try
        {   
            //
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }

    /**
     * process data.
     *
     * @return mixed
     */
    public function processData($type,$attributes)
    {
        try
        {   
            //
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }

    /**
     * get datatable.
     *
     * @return mixed
     */
    public function getDatatables()
    {
        try
        {   
            //
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }
}
