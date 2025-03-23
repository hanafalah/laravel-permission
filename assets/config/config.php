<?php

use Hanafalah\ModuleRegional\Models as ModuleRegionalModels;
use Hanafalah\ModuleRegional\Commands as ModuleRegionalCommands;

return [
    'commands' => [
        ModuleRegionalCommands\InstallMakeCommand::class
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts'
    ],
    'database' => [
        'models' => [
            //ADD YOUR MODEL HERE
        ]
    ]
];
