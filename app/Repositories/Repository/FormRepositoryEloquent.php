<?php

namespace App\Repositories\Repository;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Repositories\Contracts\FormRepository;
use App\Repositories\Auth\Service\AuthRepositorySentinel as AuthRepository;

use App\Repositories\Entities\User; 

use DB;

class FormRepositoryEloquent extends BaseRepository implements FormRepository
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
  
    private $user;

	public function __construct(User $user)
	{
      $this->user = $user;
	}

    public function userRegister($attributes)
    {
        
        try {
            $this->user->createNewUser($attributes);
            
            flash()->success('Register successfully!, please check your email to activate your account.');
            return back();
        } 
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }

    }
    
    public function contactUs($attributes)
    {
        dd($attributes);

        try {
            
        } 
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }

        return true;
    }
}