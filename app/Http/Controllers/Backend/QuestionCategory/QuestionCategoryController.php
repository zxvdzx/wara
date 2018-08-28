<?php

namespace App\Http\Controllers\Backend\QuestionCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BaseController as Controller;
use App\Repositories\Contracts\AdminQuestionCategoryRepository;

use Validator;

class QuestionCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    private $question_category_repository;

    public function __construct(AdminQuestionCategoryRepository $question_category_repository)
    {
        // $this->middleware('sentinel_access:dashboard');
        $this->question_category_repository = $question_category_repository;
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
            $index = $this->question_category_repository->getIndex();
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
            $datatables = $this->question_category_repository->getDatatables();
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
                $data = $this->question_category_repository->processData('get-data',$attributes);
            }else if($attributes['action'] == 'delete'){
                $data = $this->question_category_repository->processData('delete',$attributes);
            }else{
                $rules = ['category' => 'required'];

                $validate = Validator::make($attributes,$rules);
                if($validate->fails()) {
                    $this->validate($request,$rules);
                }else{
                    $data = $this->question_category_repository->processData('post',$attributes);
                }
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