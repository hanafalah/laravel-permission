<?php

declare(strict_types=1);

namespace Hanafalah\ModuleRegional\Providers;

use Illuminate\Support\ServiceProvider;
use Hanafalah\ModuleRegional\Commands;

class CommandServiceProvider extends ServiceProvider
{
    private $commands = [
        Commands\InstallMakeCommand::class,
    ];


    public function register()
    {
        $this->commands(config('module-regional.commands', $this->commands));
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */

    public function provides()
    {
        return $this->commands;
    }
}
