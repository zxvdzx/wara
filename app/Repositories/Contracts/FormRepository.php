<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface FormRepository
 * @package namespace App\Repositories\Contracts;
 */
interface FormRepository extends RepositoryInterface
{
	function contactUs($attributes);
	function userRegister($attributes);
}