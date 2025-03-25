<?php

namespace Hanafalah\ModuleRegional\Models\Regional;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleRegional\Concerns\LocationHasAddress;

class Location extends BaseModel
{
    use HasProps, LocationHasAddress;
    public $timestamps  = false;
}
