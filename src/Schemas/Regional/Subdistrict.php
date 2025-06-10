<?php

namespace Hanafalah\ModuleRegional\Schemas\Regional;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleRegional\Contracts\Schemas\Regional\Subdistrict as RegionalSubdistrict;

class Subdistrict extends PackageManagement implements RegionalSubdistrict
{
    protected string $__entity = 'Subdistrict';
    public static $subdistrict_model;
}
