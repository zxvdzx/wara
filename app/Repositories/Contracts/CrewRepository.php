<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CrewRepository
 * @package namespace App\Repositories\Contracts;
 */
interface CrewRepository extends RepositoryInterface
{
	function getIndex();
}