<?php

namespace Hanafalah\ModuleRegional\Concerns;

trait HasLocation
{
  public function province(){return $this->belongsToModel('Province');}
  public function district(){return $this->belongsToModel('District');}
  public function subdistrict(){return $this->belongsToModel('Subdistrict');}
  public function village(){return $this->belongsToModel('Village');}
}
