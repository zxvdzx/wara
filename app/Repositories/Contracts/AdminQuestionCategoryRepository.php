<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AdminQuestionCategoryRepository
 * @package namespace App\Repositories\Contracts;
 */
interface AdminQuestionCategoryRepository extends RepositoryInterface
{
	function getIndex();
	function getDatatables();
	function processData($type, $attributes);
}