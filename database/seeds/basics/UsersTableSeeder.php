<?php

use App\Repositories\Entities\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $roleSlugsArray = [         
		'member', 'hq-admin',     
	];

    public function run()
    {
    	DB::table('users')->truncate();         
		DB::table('activations')->truncate();         
		DB::table('persistences')->truncate();         
		DB::table('reminders')->truncate();         
		DB::table('role_users')->truncate();         
		DB::table('throttle')->truncate();

        Sentinel::registerAndActivate([             
			'avatar' => '',             
			'email' => 'superadmin@domain.com',             
			'password' => User::DEFAULT_PASSWORD,             
			'first_name' => 'Super',             
			'last_name' => 'Administrator',             
			'is_admin' => true,         
		]);         
		Sentinel::findRoleBySlug('super-admin')->users()->attach(Sentinel::findById(1));         
		
		Sentinel::registerAndActivate([             
			'avatar' => '',             
			'email' => 'hqadmin@domain.com',             
			'password' => User::DEFAULT_PASSWORD,             
			'first_name' => 'HQ',             
			'last_name' => 'Administrator',             
			'is_admin' => true,         
		]);         
		Sentinel::findRoleBySlug('hq-admin')->users()->attach(Sentinel::findById(2));  

		Sentinel::registerAndActivate([             
			'avatar' => '',             
			'email' => 'member@domain.com',             
			'password' => User::DEFAULT_PASSWORD,             
			'first_name' => 'Member',             
			'last_name' => 'User',              
			'is_admin' => false,         
		]);         
		Sentinel::findRoleBySlug('member')->users()->attach(Sentinel::findById(3));
    }
}
