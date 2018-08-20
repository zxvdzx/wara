<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PermissionRepository
 * @package namespace App\Repositories\Contracts;
 */
interface PermissionRepository extends RepositoryInterface
{
    function listPermissions();

    function formatLabelToPermission($permissionLabel);

    function listPermissionsFromLabels($labelList);

    function validateLabels($labelList);

}
