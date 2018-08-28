<?php

namespace App\Repositories\Repository;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PermissionRepository;
use App\Repositories\Entities\Permission;
use App\Repositories\Validators\PermissionValidator;

/**
 * Class PermissionRepositoryEloquent
 * @package namespace App\Repositories\Repository;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * List all permissions in Sentinel format.
     *
     * @return mixed
     */
    public function listPermissions()
    {
        try
        {   
            return $this->model->listPermissions();
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }

    /**
     * Format to permission from label.
     *
     * @param string $permissionLabel
     * @return void
     */
    public function formatLabelToPermission($permissionLabel)
    {
        try
        {   
            return $this->model->formatLabelToPermission($permissionLabel);
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }

    /**
     * Format only listed permission label.
     *
     * @param mixed $labelList
     * @return void
     */
    public function listPermissionsFromLabels($labelList)
    {
        try
        {   
            return $this->model->listPermissionsFromLabels($labelList);
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }

    /**
     * Exclude invalid permission label.
     *
     * @param mixed $labelList
     * @return mixed
     */
    public function validateLabels($labelList)
    {
        try
        {   
            return $this->model->validateLabels($labelList);
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }

    /**
     * List all permissions label
     *
     * @return mixed
     */
    public function listPermissionsLabels()
    {
        try
        {   
            return $this->model->listPermissionsLabels();
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }

    /**
     * Get Permission list from config by role slug
     *
     * @param string $roleSlug
     * @return void
     */
    public function getPermissionListFromConfig($roleSlug)
    {
        try
        {   
            return $this->model->getPermissionListFromConfig($roleSlug);
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }
}
