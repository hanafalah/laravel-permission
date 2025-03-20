<?php

namespace Hanafalah\LaravelPermission\Commands;

class InstallMakeCommand extends EnvironmentCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-permission:install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command ini digunakan untuk installing permission';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $provider = 'Hanafalah\LaravelPermission\LaravelPermissionServiceProvider';

        $this->comment('Installing Laravel Permission...');
        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'config'
        ]);
        $this->info('✔️  Created config/laravel-permission.php');

        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'migrations'
        ]);
        $this->info('✔️  Created migrations');

        $migrations = $this->setMigrationBasePath(database_path('migrations'))->canMigrate();
        $this->callSilent('migrate', ['--path' => $migrations]);

        $this->info('✔️  App table migrated');
        $this->comment('hanafalah/laravel-permission installed successfully.');
    }
}
