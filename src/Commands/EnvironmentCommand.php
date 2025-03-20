<?php

namespace Zahzah\LaravelPermission\Commands;

use Zahzah\LaravelSupport\{
    Commands\BaseCommand,
    Concerns\ServiceProvider\HasMigrationConfiguration,
    Concerns\Support\HasMicrotenant
};

class EnvironmentCommand extends BaseCommand
{
    use HasMigrationConfiguration;
    use HasMicrotenant; 

    protected function init(): self{
        //INITIALIZE SECTION
        $this->initConfig()->setLocalConfig('laravel-permission');
        return $this;
    }

    protected function dir(): string{
        return __DIR__.'/../';
    }
}
