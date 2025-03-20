<?php

namespace Hanafalah\ModuleRegional\Models\Citizenship;

use Hanafalah\LaravelSupport\Models\BaseModel;

class Country extends BaseModel
{
  const INDONESIA       = 101;
  public $timestamps    = false;
  protected $fillable   = ["id", "country_code", "name"];
}
