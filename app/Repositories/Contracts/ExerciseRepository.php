<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ExerciseRepository
 * @package namespace App\Repositories\Contracts;
 */
interface ExerciseRepository extends RepositoryInterface
{
	function getIndex();
	function post($attributes);
}