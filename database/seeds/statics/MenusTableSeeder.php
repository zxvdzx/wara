<?php

use App\Repositories\Entities\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();
        
        Menu::createMenus($this->getMenus());
    }

    private function getMenus()
    {
        return [
            ['is_parent' => false, 'name' => str_slug('Dashboard'), 'display_name' => 'Dashboard', 'icon' => 'tachometer', 'href' => 'admin/dashboard', 'pattern' => 'dashboard'],
        /* Super Admin */
            ['is_parent' => true, 'name' => str_slug('Super Admin Account Management'), 'display_name' => 'Account Management', 'icon' => 'users', 'href' => '#', 'pattern' => 'user-trustees', 'child' => [
                ['name' => str_slug('Super Admin Menu Management'), 'display_name' => 'Menu Management', 'icon' => 'bars', 'href' => 'admin/user-trustees/menus', 'pattern' => 'user-trustees'],
                ['name' => str_slug('Super Admin Role Management'), 'display_name' => 'Role Management', 'icon' => 'user-secret', 'href' => 'admin/user-trustees/roles', 'pattern' => 'user-trustees'],
                ['name' => str_slug('Super Admin User Management'), 'display_name' => 'User Management', 'icon' => 'users', 'href' => 'admin/user-trustees/users', 'pattern' => 'user-trustees'],
            ]],    
        ];
    }
}
