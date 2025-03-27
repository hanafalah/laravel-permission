<?php

namespace Hanafalah\ModuleRegional\Concerns;

trait LocationHasAddress
{
  public function initializeLocationHasAddress(){
    $this->mergeFillable([
      'id','code','name','latitude','longitude'
    ], $this->getFillable());
  }

  public function address(){
    return $this->belongsToModel('Address');
  }
}
