<?php

namespace App\Http\Controllers\Backend\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BaseController as Controller;
use App\Repositories\Contracts\AdminQuestionRepository;

use Validator;

class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    private $question_repository;

    public function __construct(AdminQuestionRepository $question_repository)
    {
        // $this->middleware('sentinel_access:dashboard');
        $this->question_repository = $question_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $index = $this->question_repository->getIndex();
        }
        catch (\Exception $e) 
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
        
        return $index;
    }

    public function datatables()
    {
        try
        {
            $datatables = $this->question_repository->getDatatables();
        }
        catch (\Exception $e) 
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
        
        return $datatables;
    }
    
    public function postData(Request $request)
    {
        try
        {
            $attributes = $request->all();
            if($attributes['action'] == 'get-data'){
                $data = $this->question_repository->processData('get-data',$attributes);
            }else if($attributes['action'] == 'delete'){
                $data = $this->question_repository->processData('delete',$attributes);
            }else{
                // $rules = ['category' => 'required'];

                // $validate = Validator::make($attributes,$rules);
                // if($validate->fails()) {
                //     $this->validate($request,$rules);
                // }else{
                    $data = $this->question_repository->processData('post',$attributes);
                // }
            }
        }
        catch (\Exception $e) 
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
        
        return $data;
    }
}