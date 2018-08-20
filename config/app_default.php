<?php

return [
    // All default permissions
    'permissions' => [
        'backend',
        'dashboard',
        'super.admin.menu.management',
        'super.admin.role.management',
        'super.admin.user.management',
    ],
    // All default Roles
    'roles' => [
        'super-admin' => [
            'name' => "Super Administrator",
            'slug' => 'super-admin',
            'permissions' => [
                'backend',
                'dashboard',
                'super.admin.menu.management',
                'super.admin.role.management',
                'super.admin.user.management',
            ],
        ],
        'hq-admin' => [
            'name' => "HQ Admin",
            'slug' => 'hq-admin',
            'permissions' => [],
        ],
        'member' => [
            'name' => "Member",
            'slug' => 'member',
            'permissions' => [],
        ],
    ],

];