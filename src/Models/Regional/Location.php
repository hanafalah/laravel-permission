<?php

namespace Hanafalah\ModuleRegional\Models\Regional;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;

class Location extends BaseModel
{
    use HasProps;

    protected $fillable = [
        'id',
        'code',
        'name',
        'latitude',
        'longitude'
    ];
}
