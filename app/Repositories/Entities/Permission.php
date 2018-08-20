<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Permission extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'permissions';

    protected $fillable = [
        'label',
    ];

    /**
     * List all permissions in Sentinel format.
     *
     * @return mixed
     */
    public function listPermissions()
    {
        $permissions = $this->all();
        $permissionList = [];

        foreach ($permissions as $permission)
        {
            array_push($permissionList,
                [$permission->label => true]);
        }

        return $permissionList;
    }

    /**
     * Format to permission from label.
     *
     * @param string $permissionLabel
     * @return void
     */
    public function formatLabelToPermission($permissionLabel)
    {
        return [$permissionLabel => true];
    }

    /**
     * Format only listed permission label.
     *
     * @param mixed $labelList
     * @return void
     */
    public function listPermissionsFromLabels($labelList)
    {
        $permissionList = [];

        if (is_array($labelList) && count($labelList))
        {

            $labelList = $this->validateLabels($labelList);

            foreach ($labelList as $label)
            {
                array_push($permissionList, $this->formatLabelToPermission($label));
            }
        }

        return $permissionList;
    }

    /**
     * Exclude invalid permission label.
     *
     * @param mixed $labelList
     * @return mixed
     */
    public function validateLabels($labelList)
    {
        // DEVNOTE: pluck returns collection or array?
        $permissions = $this->all()->pluck('label');

        $labelList = $permissions->intersect($labelList);

        return $labelList;
    }

    /**
     * List all permissions label
     *
     * @return mixed
     */
    public function listPermissionsLabels()
    {
        $permissions = $this->all()->pluck('label')->all();

        return $permissions;
    }

    /**
     * Get Permission list from config by role slug
     *
     * @param string $roleSlug
     * @return void
     */
    public function getPermissionListFromConfig($roleSlug)
    {
        $myRolePermissions = \Config::get('app_default.roles.'.$roleSlug.'.permissions');

        return $this->listPermissionsFromLabels($myRolePermissions);
    }

    /**
     * Get Permission list from config by role slug (Profile)
     *
     * @param string $roleSlug
     * @return void
     */
    public function getProfilePermissionListFromConfig($roleSlug)
    {
        $myRolePermissions = \Config::get('app_profile_default.roles.'.$roleSlug.'.permissions');

        return $this->listPermissionsFromLabels($myRolePermissions);
    }

    /**
     * Validate Permission Items.
     *
     * @param mixed $permissionItems
     * @return void
     */
    public function validatePermissionItems($permissionItems)
    {
        $permissionLabels = [];

        foreach ($permissionItems as $permissionItem)
        {
            foreach ($permissionItem as $permissionLabel => $permissionLabelOption)
            {
                if ($permissionLabelOption === TRUE)
                    $permissionLabels[] = $permissionLabel;
            }
        }

        return $this->listPermissionsFromLabels($permissionLabels);
    }
}
