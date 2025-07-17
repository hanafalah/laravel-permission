<?php

namespace Hanafalah\ModuleRegional\Schemas\Regional;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleRegional\Contracts\Schemas\Regional\District as RegionalDistrict;

class District extends PackageManagement implements RegionalDistrict
{
    protected string $__entity = 'District';
    public static $district_model;
}
