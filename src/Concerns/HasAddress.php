<?php

namespace Hanafalah\ModuleRegional\Concerns;

use Hanafalah\ModuleRegional\Data\AddressData;

trait HasAddress
{
  public function setAddress($flag, $address){
    if (isset($flag)) {
        $address = app(config('app.contracts.Address'))
                  ->prepareStoreAddress(AddressData::from($this->mergeArray($address,[
                    'flag'       => $flag, 
                    'model_id'   => $this->getKey(),
                    'model_type' => $this->getMorphClass()
                  ])));
        return $address;
    } else {
        return null;
    }
  }

  public function address(){return $this->morphOneModel('Address','model');}
  public function addresses(){return $this->morphManyModel('Address','model');}
}
