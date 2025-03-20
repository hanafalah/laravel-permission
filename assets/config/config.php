<?php 

use Zahzah\LaravelPermission\{
    Models, Commands, Contracts
};

return [    
    'contracts' => [
        'laravel_permission' => Contracts\LaravelPermission::class,
        'permission'         => Contracts\Permission::class,
        'role'               => Contracts\Role::class
    ],
    'database' => [
        'models' => [
            'Role'               => Models\Role\Role::class,
            'Permission'         => Models\Permission\Permission::class,
            'ModelHasRole'       => Models\Role\ModelHasRole::class,
            'ModelHasPermission' => Models\Permission\ModelHasPermission::class,
            'RoleHasPermission'  => Models\Role\RoleHasPermission::class,
        ]
    ],
    'commands' => [
        Commands\InstallMakeCommand::class
    ]
];