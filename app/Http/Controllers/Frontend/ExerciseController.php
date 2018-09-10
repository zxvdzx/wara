<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BaseController as Controller;
use App\Repositories\Contracts\ExerciseRepository;

use Input;
use Carbon\Carbon;
use Validator;

class ExerciseController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    private $form_repository;

    public function __construct(ExerciseRepository $exercise_repository)
    {
        // $this->middleware('sentinel_access:dashboard');
        $this->exercise_repository = $exercise_repository;
    }

    public function index()
    {
        try
        {
            $index = $this->exercise_repository->getIndex();
        }
        catch (\Exception $e) 
        {
            errorLog($e);
            throw new \Exception($e->getMessage());
        }

        return $index;
    }
    
    public function post(Request $request)
    {
        $attributes = $request->all();

        try{

            $quiz = $this->exercise_repository->post($attributes);
        }
        catch (\Exception $e) 
        {
            errorLog($e);
            throw new \Exception($e->getMessage());
        }
        
        return $quiz;
    }
}