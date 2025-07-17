<?php

namespace Hanafalah\ModuleRegional\Models\Citizenship;

use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleRegional\Resources\Country\ViewCountry;

class Country extends BaseModel
{
  const INDONESIA       = 101;
  public $timestamps    = false;
  protected $fillable   = ["id", "country_code", "name"];

  public function getViewResource(){
    return ViewCountry::class;
  }

  public function getShowResource(){
    return ViewCountry::class;
  }
}
