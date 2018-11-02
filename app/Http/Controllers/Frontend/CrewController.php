<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BaseController as Controller;
use App\Repositories\Contracts\CrewRepository;

use Input;
use Carbon\Carbon;
use Validator;

class CrewController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    private $form_repository;

    public function __construct(CrewRepository $crew_repository)
    {
        // $this->middleware('sentinel_access:dashboard');
        $this->crew_repository = $crew_repository;
    }

    public function index()
    {
        try
        {
            $index = $this->crew_repository->getIndex();
        }
        catch (\Exception $e) 
        {
            errorLog($e);
            throw new \Exception($e->getMessage());
        }

        return $index;
    }
}