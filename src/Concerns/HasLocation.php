<?php

namespace Zahzah\ModuleRegional\Concerns;

trait HasLocation
{
    public function setAddress($flag,$address){
      if (isset($flag)){
        $address = $this->address()->updateOrCreate([
          'model_id'   => $this->{$this->getKeyName()},
          'model_type' => $this->getMorphClass(),
          'flag'       => $flag
        ],$address);
        return $address;
      }else{
        return null;
      }
    }

    public function initializeHasLocation(){
        $this->mergeFillable([
            'id','code','name','latitude','longitude'
        ],$this->getFillable());
    }

    public function address(){return $this->morphOneModel('Address','model');}
    public function addresses(){return $this->morphManyModel('Address','model');}
}