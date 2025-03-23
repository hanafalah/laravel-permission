<?php

declare(strict_types=1);

namespace Hanafalah\ModuleRegional;

use Hanafalah\LaravelSupport\Providers\BaseServiceProvider;

class ModuleRegionalServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return $this
     */
    public function register()
    {
        $this->registerMainClass(ModuleRegional::class)
            ->registerCommandService(Providers\CommandServiceProvider::class)
            ->registers([
                '*',
                'Namespace' => function () {
                    $this->publishes([
                        $this->getAssetPath('/database/migrations/data') => database_path('data'),
                    ], 'data');
                },
                'Services' => function () {
                    $this->binds([
                        Contracts\ModuleRegional::class => ModuleRegional::class
                    ]);
                }
            ]);
    }

    /**
     * Get the base path of the package.
     *
     * @return string
     */
    protected function dir(): string
    {
        return __DIR__ . '/';
    }

    protected function migrationPath(string $path = ''): string
    {
        return database_path($path);
    }
}
