<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface FeDashboardRepository
 * @package namespace App\Repositories\Contracts;
 */
interface FeDashboardRepository extends RepositoryInterface
{
	function getIndex();
}