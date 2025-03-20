<?php

declare(strict_types=1);

namespace Hanafalah\LaravelPermission;

use Hanafalah\LaravelSupport\Providers\BaseServiceProvider;

class LaravelPermissionServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return $this
     */
    public function register()
    {
        $this->registerMainClass(LaravelPermission::class)
            ->registerCommandService(Providers\CommandServiceProvider::class)
            ->registers([
                '*',
                'Services' => function () {
                    $this->binds([
                        Contracts\LaravelPermission::class => new LaravelPermission,
                        Contracts\Permission::class => new Schemas\Permission,
                        Contracts\Role::class => new Schemas\Role,
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
}
