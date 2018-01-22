<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AuthRepository
 * @package namespace App\Repositories\Contracts;
 */
interface AuthRepository extends RepositoryInterface
{
	function postLogin($attributes);

	function postSignup($attributes);
}