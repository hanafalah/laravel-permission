<?php

namespace Hanafalah\ModuleRegional\Schemas\Citizenship;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleRegional\Contracts\Schemas\Citizenship\Country as CitizenshipCountry;

class Country extends PackageManagement implements CitizenshipCountry
{
    protected string $__entity = 'Country';
    public static $country_model;
}
