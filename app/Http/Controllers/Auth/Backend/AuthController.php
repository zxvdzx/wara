<?php

namespace App\Http\Controllers\Auth\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use App\Repositories\Contracts\AdminAuthRepository;

use Validator;
use Sentinel;
use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    // use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    private $admin_auth_repository;
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(AdminAuthRepository $admin_auth_repository)
    {
        $this->admin_auth_repository = $admin_auth_repository;
        // $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function getLogin()
    {

        try{
            $loginPage = $this->admin_auth_repository->getLogin();
        }
        catch (\Exception $e) 
        {
            throw new \Exception($e->getMessage());
        }

        return $loginPage;
    }

    public function postLogin(Request $request)
    {
        $param = $request->all();

        $rules = [
              'email' => 'required|email',
              'password' => 'required|min:8',
            ];

        $messages = [
                    'email.required'        => 'Email is required',
                    'email.email'           => 'Email is invalid',
                    'password.required'     => 'Password is required',
                    'password.min'          => 'Password needs to have at least 8 characters',
                ];

        $validate = Validator::make($param, $rules, $messages);
        
        if($validate->fails()) {
            $this->validate($request, $rules, $messages);
        } else {
            try{
                $postLogin = $this->admin_auth_repository->postLogin($param);
            }
            catch (\Exception $e) 
            {
                throw new \Exception($e->getMessage());
            }
        }
        return $postLogin;
    }

    public function getLogout()
    {
        try{
            $getLogout = $this->admin_auth_repository->getLogout();
        }
        catch (\Exception $e) 
        {
            throw new \Exception($e->getMessage());
        }
        
        return $getLogout;
    }
}