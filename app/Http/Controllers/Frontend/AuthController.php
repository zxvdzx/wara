<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BaseController as Controller;
use App\Repositories\Contracts\AuthRepository;

use Input;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        // $this->middleware('sentinel_access:dashboard');
        $this->authRepository = $authRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request)
    {
        $attributes = $request->all();

        try
        {
            $signup = $this->authRepository->postSignup($attributes);
        }
        catch (\Exception $e) 
        {
            throw new \Exception($e->getMessage(), null, $e);
        }
        
        return $signup;
    }
}
