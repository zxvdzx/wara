<?php

namespace App\Repositories\Repository;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CrewRepository;

use App\Repositories\Auth\Service\AuthRepositorySentinel as AuthRepository;

use DB;
use Input;

class CrewRepositoryEloquent extends BaseRepository implements CrewRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        //
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    // /**
    //  * Repository presenter
    //  */
    // public function presenter()
    // {
    //     return 'App\\Repositories\\Presenters\\PortfolioPresenter';
    // }

	/**
	* @var $model
	*/

	public function __construct(AuthRepository $auth_repository)
	{
        $this->auth_repository = $auth_repository;
	}

	public function getIndex()
  	{
        try
        {   
            return view('frontend.crew');
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }
}