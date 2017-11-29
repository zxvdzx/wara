<?php

namespace App\Repositories\Repository;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Repositories\Contracts\DashboardRepository;
// use App\Repositories\Entities\User; 

// use DB;
// use Hash;
// use Input;
// use Sentinel;

class DashboardRepositoryEloquent extends BaseRepository implements DashboardRepository
{
  /**
   * Specify Model class name
   *
   * @return string
   */
  public function model()
  {
      // return Portofolio::class;
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
  // private $model_user_repository;

	public function __construct()
	{
    // $this->model_user_repository = $model_user_repository;
	}

	public function getIndex()
  {
		return view('backend.dashboard');
	}
}