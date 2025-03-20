<?php

namespace Zahzah\ModuleRegional\Models\Citizenship;

use Zahzah\LaravelSupport\Models\BaseModel;

class Country extends BaseModel
{
  const INDONESIA       = 101;
  public $timestamps    = false;
  protected $fillable   = ["id","country_code","name"];
}
