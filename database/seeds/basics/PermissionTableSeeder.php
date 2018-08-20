<?php

use Illuminate\Database\Seeder;
use Illuminate\Container\Container as App;

class PermissionTableSeeder extends Seeder
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
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->delete();
        \DB::table('permissions')->truncate();

        $permissionGroup = \Config::get('app_default.permissions');
        foreach ($permissionGroup as $permission)
        {
            $item = $this->permission->create([
                'label' => $permission,
            ]);
        }

    }
}