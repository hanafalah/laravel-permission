<?php

use Hanafalah\LaravelPermission\{
    Models,
    Commands,
    Contracts
};

return [
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
        ]
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas'
    ],
    'database' => [
        'models' => [
            //ADD YOUR MODELS HERE
        ]
    ],
    'commands' => [
        Commands\InstallMakeCommand::class
    ]
];
