<?php

namespace Hanafalah\LaravelPermission\Supports;

use Hanafalah\LaravelSupport\Supports\PackageManagement;

class BaseLaravelPermission extends PackageManagement
{
    /** @var array */
    protected $__laravel_permission_config = [];

    /**
     * A description of the entire PHP function.
     *
     * @param Container $app The Container instance
     * @throws Exception description of exception
     * @return void
     */
    public function __construct()
    {
        $this->setConfig('laravel-permission', $this->__laravel_permission_config);
    }
}
