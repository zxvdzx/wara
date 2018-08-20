<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AdminAuthRepository
 * @package namespace App\Repositories\Contracts;
 */
interface AdminAuthRepository extends RepositoryInterface
{
	function getLogin();
	
	function postLogin($attributes);

	function getLogout();
}