<?php

use Illuminate\Database\Seeder;
use Illuminate\Container\Container as App;

class RolesTableSeeder extends Seeder
{
    private $app;
    private $permission;
    private $permissionRepository = 'App\Repositories\Contracts\PermissionRepository';

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->permission = $this->app->make($this->permissionRepository);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->truncate();
        DB::table('roles')->truncate();

        $defaultRoles = \Config::get('app_default.roles');

        foreach ($defaultRoles as $roleGroup => $data)
        {
            $this->createRole($roleGroup, $data);
        }
    }

    public function createRole($roleGroup, $data)
    {
        // Create Role
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => $data['name'],
            'slug' => $data['slug'],
        ]);

        // Get all permission
        $role->permissions = $this->permission->getPermissionListFromConfig($roleGroup);

        $role->save();

        return $role;
    }
}
