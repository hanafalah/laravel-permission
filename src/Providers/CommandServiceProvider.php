<?php

namespace Hanafalah\LaravelPermission\Providers;

use Illuminate\Support\ServiceProvider;
use Hanafalah\LaravelPermission\Commands;

class CommandServiceProvider extends ServiceProvider
{
    protected $__commands = [
        Commands\InstallMakeCommand::class
    ];

    public function register()
    {
        $this->commands(config('laravel-permission.commands', $this->__commands));
    }

    public function provides()
    {
        return $this->__commands;
    }
}
