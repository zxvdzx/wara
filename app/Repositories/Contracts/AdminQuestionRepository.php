<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AdminQuestionRepository
 * @package namespace App\Repositories\Contracts;
 */
interface AdminQuestionRepository extends RepositoryInterface
{
    function getIndex();
	function getDatatables();
	function processData($type, $attributes);
}