<?php

namespace Hanafalah\ModuleRegional\Schemas\Regional;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleRegional\Contracts\Schemas\Regional\Province as RegionalProvince;

class Province extends PackageManagement implements RegionalProvince
{
    protected string $__entity = 'Province';
    public static $province_model;
}
