<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\Contracts\AuthRepository;

use Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    private $authRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
        $this->middleware('guest')->except('logout');
    }

    /**
     * post login user
     */
    public function postLogin(Request $request)
    {
        $attributes = $request->all();

        try{
            $login = $this->authRepository->postLogin($attributes);
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }

        return $login;
    }
}
