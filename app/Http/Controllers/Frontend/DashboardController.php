<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BaseController as Controller;
use App\Repositories\Contracts\FeDashboardRepository;

use Input;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    private $dashboard_repository;

    public function __construct(FeDashboardRepository $dashboard_repository)
    {
        // $this->middleware('sentinel_access:dashboard');
        $this->dashboard_repository = $dashboard_repository;
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
            $index = $this->dashboard_repository->getIndex();
        }
        catch (\Exception $e) 
        {
            throw new \Exception($e->getMessage());
        }
        
        return $index;
    }
}
