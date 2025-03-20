<?php 

use Zahzah\ModuleRegional\Models as ModuleRegionalModels;
use Zahzah\ModuleRegional\Commands as ModuleRegionalCommands;

return [
    'commands' => [
        ModuleRegionalCommands\InstallMakeCommand::class
    ],
    'database' => [
        'models' => [
            'ModelHasCoordinate' => ModuleRegionalModels\Maps\ModelHasCoordinate::class,
            'Address'            => ModuleRegionalModels\Regional\Address::class,
            'District'           => ModuleRegionalModels\Regional\District::class,
            'Location'           => ModuleRegionalModels\Regional\Location::class,
            'Province'           => ModuleRegionalModels\Regional\Province::class,
            'Subdistrict'        => ModuleRegionalModels\Regional\Subdistrict::class,
            'Village'            => ModuleRegionalModels\Regional\Village::class,
            'Country'            => ModuleRegionalModels\Citizenship\Country::class
        ]
    ]
];