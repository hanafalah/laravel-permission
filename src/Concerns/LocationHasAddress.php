<?php

namespace Hanafalah\ModuleRegional\Concerns;

trait LocationHasAddress
{
  public function initializeHasLocation()
  {
    $this->mergeFillable([
      'id','code','name','latitude','longitude'
    ], $this->getFillable());
  }

  public function address(){
    return $this->belongsToModel('Address');
  }
}
