<?php

namespace Hanafalah\ModuleRegional\Schemas\Regional;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleRegional\Contracts\Schemas\Regional\Village as RegionalVillage;

class Village extends PackageManagement implements RegionalVillage
{
    protected string $__entity = 'Village';
    public static $village_model;
}
