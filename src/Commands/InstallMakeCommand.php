<?php

namespace Hanafalah\ModuleRegional\Commands;

class InstallMakeCommand extends EnvironmentCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module-regional:install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command ini digunakan untuk installing awal module regional';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $provider = 'Hanafalah\ModuleRegional\ModuleRegionalServiceProvider';

        $this->comment('Installing Module Regional...');
        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'config'
        ]);
        $this->info('✔️  Created config/module-regional.php');

        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'migrations'
        ]);

        $this->callSilent('vendor:publish', [
            '--provider' => $provider,
            '--tag'      => 'data'
        ]);
        $this->info('✔️  Created migrations');

        $this->comment('hanafalah/module-regional installed successfully.');
    }
}
