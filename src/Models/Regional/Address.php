<?php

namespace Hanafalah\ModuleRegional\Models\Regional;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleRegional\Concerns\HasLocation;
use Hanafalah\ModuleRegional\Enums\Address\Flag;
use Hanafalah\ModuleRegional\Resources\Address\{
  ViewAddress, ShowAddress
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends BaseModel
{
  use HasUlids, HasProps, HasLocation, SoftDeletes;

  public $incrementing = false;
  protected $keyType = 'string';
  protected $primaryKey = 'id';
  protected $list = [
    'id', 'name', 'model_type', 'model_id', 'flag', 
    'province_id', 'district_id', 'subdistrict_id', 'village_id', 
    'props'
  ];
  protected $show = [
  ];

  protected $cast = [
    'name'             => 'string',
    'province_name'    => 'string',
    'district_name'    => 'string',
    'subdistrict_name' => 'string',
    'village_name'     => 'string',
    'zip_code'         => 'string'
  ];

  public function getPropsQuery(): array
  {
    return [
      'province_name'    => 'props->prop_province->name',
      'district_name'    => 'props->prop_district->name',
      'subdistrict_name' => 'props->prop_subdistrict->name',
      'village_name'     => 'props->prop_village->name',
      'zip_code'         => 'props->zip_code'
    ];
  }

  public function getViewResource(){
    return ViewAddress::class;
  }

  public function getShowResource(){
    return ShowAddress::class;
  }

  public function getAddressFlag(){
    switch ($this->flag) {
      case Flag::KTP->value       : return 'ktp_address';break;
      case Flag::RESIDENCE->value : return 'residence_address';break;
      case Flag::OTHER->value     : return 'other';break;
    }
  }

  public function model(){return $this->morphTo();}
}
