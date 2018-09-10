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
	function getLoginMember();
	
	function postLogin($attributes);
	function activationUser($id, $code);

	function getLogout();
	function getLogoutMember();
}