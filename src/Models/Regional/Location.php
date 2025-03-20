<?php

namespace Zahzah\ModuleRegional\Models\Regional;

use Zahzah\LaravelHasProps\Concerns\HasProps;
use Zahzah\LaravelSupport\Models\BaseModel;

class Location extends BaseModel{
    use HasProps;

    protected $fillable = [
        'id','code','name','latitude','longitude'
    ];
}