<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BaseController as Controller;
use App\Repositories\Contracts\FormRepository;

use Input;
use Carbon\Carbon;
use Validator;

class FormController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    private $form_repository;

    public function __construct(FormRepository $form_repository)
    {
        // $this->middleware('sentinel_access:dashboard');
        $this->form_repository = $form_repository;
    }

    public function userRegister(Request $request)
    {
        $param = $request->all();
        
        $rules = [
              'firstName' => 'required',
              'email' => 'required|email|max:255|unique:users',
              'birthdate' => 'required',
              'birthplace' => 'required',
              'password' => 'required|min:8|confirmed',
              'password_confirmation' => 'required|same:password',
              'phone' => 'required',
              'address' => 'required',
              'gender' => 'required',
            ];

        $messages = [
                    'email.required'        => 'Email is required',
                    'email.email'           => 'Email is invalid',
                ];

        $validate = Validator::make($param, $rules,$messages);
        
        if($validate->fails()) {
            $this->validate($request, $rules,$messages);
        } else {
            try{

                $postLogin = $this->form_repository->userRegister($param);
            }
            catch (\Exception $e) 
            {
                errorLog($e);
                throw new \Exception($e->getMessage());
            }
        }
        return $postLogin;
    }
}