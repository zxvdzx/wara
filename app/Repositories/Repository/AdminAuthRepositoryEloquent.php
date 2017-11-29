<?php

namespace App\Repositories\Repository;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Repositories\Contracts\AdminAuthRepository;
use App\Repositories\Auth\Service\AuthRepositorySentinel as AuthRepository;

use App\Repositories\Entities\User; 
use App\Repositories\Entities\AuthLog; 

use DB;
use Hash;
use Input;
use Sentinel;
use Session;
use Validator;
use Request;

class AdminAuthRepositoryEloquent extends BaseRepository implements AdminAuthRepository
{
  /**
   * Specify Model class name
   *
   * @return string
   */
  public function model()
  {
      return User::class;
  }

  /**
   * Boot up the repository, pushing criteria
   */
  public function boot()
  {
      $this->pushCriteria(app(RequestCriteria::class));
  }

	/**
	* @var $model
	*/
  
  private $model_user;
  private $model_auth_log;

	public function __construct(
                              AuthRepository $auth_repository,
                              User $model_user, 
                              AuthLog $model_auth_log)
	{
      $this->model_user = $model_user;
      $this->model_auth_log = $model_auth_log;
      $this->auth_repository = $auth_repository;
	}

	public function getLogin()
  {
      $form = [
          'url' => route('admin.login'),
          'autocomplete' => 'off',
      ];

      return view('auth.backend.login', compact('form'))->with('type','admin');
	}

  public function postLogin($attributes)
  {
    if($attributes['type'] == "member"){
        $route_login_type = "member.login";
        $route_dashboard_type = "member.dashboard";
    }else{
        $route_login_type = "admin.login";
        $route_dashboard_type = "admin.dashboard";
    }

    $backToLogin = redirect()->route($route_login_type)->withInput();
    $findUser = Sentinel::findByCredentials(['login' => $attributes['email']]);

    // If we can not find user based on email...
    if (! $findUser) {
        flash()->error('Wrong email!');

        return $backToLogin;
    }

    try {
        $remember = (isset($attributes['rememberMe'])) ? true : false;
        $user = User::where('email',$attributes['email']);
        if($user->count() > 0){
            $user = User::find($user->first()->id);
        }
        
        // If password is incorrect...
        if (! Sentinel::authenticate($attributes, $remember)) {
            flash()->error('Password is incorrect!');
            
            return $backToLogin;
        }
        $role_slug = $this->auth_repository->getUserInfo('role');
        
        if (strtolower($role_slug) != 'member' and $attributes['type'] == "member" or strtolower($role_slug) == 'member' and $attributes['type'] == "admin") {
            flash()->error('You Have No Access!');
            Sentinel::logout();

            return $backToLogin;
        }

        if ($remember == TRUE) {
            Session::put('field_email', $attributes['email']);
            Session::put('field_password', $attributes['password']);
        }

        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        $ipAddress = $ip;
        
        $userId = $this->auth_repository->getUserInfo('id');

        AuthLog::create([
          'user_id' => $userId,
          'ip_address' => $ipAddress,
          'login' => date('Y-m-d H:i:s'),
        ]);

        flash()->success('Login success!');

        return redirect()->route($route_dashboard_type);
    } catch (ThrottlingException $e) {

        flash()->error('Too many attempts!');
    } catch (NotActivatedException $e) {

        flash()->error('Please activate your account before trying to log in.');
    }

    return $backToLogin;
  }

  public function getLogout()
  {
      $route = 'admin.login';      
      $userId = $this->auth_repository->getUserInfo('id');

      $idLog = AuthLog::getLastIdByCurrentUser($userId);

      $logs = AuthLog::find($idLog);
      if($logs){
          $logs->logout = date('Y-m-d H:i:s');
          $logs->save();
      }

      setcookie("isAuthorized");

      Sentinel::logout();
      
      return redirect()->route($route);
  }
}