<?php

namespace Hanafalah\ModuleRegional\Models\Regional;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleRegional\Enums\Address\Flag;

class Address extends BaseModel
{
  use HasProps;

  protected $list = ['id', 'name', 'model_type', 'model_id', 'flag', 'province_id', 'district_id', 'subdistrict_id', 'village_id', 'props'];
  protected $show = ['province_id', 'district_id', 'subdistrict_id', 'village_id', 'props'];

  /**
   * Fetch the related location (province, district, subdistrict, and 
   * optionally village) from the database.
   * 
   * @param  \Illuminate\Database\Eloquent\Builder  $builder
   * @param  bool  $using_village
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeFullLocation($builder, bool $using_village = true)
  {
    $builder->with(['province', 'district', 'subdistrict']);
    if ($using_village) $builder->with('village');
    return $builder;
  }

  public function getAddressFlag()
  {
    switch ($this->flag) {
      case  Flag::ID_CARD->value:
        return 'ktp_address';
        break;
      case  Flag::RESIDENCE->value:
        return 'residence_address';
        break;
      case  Flag::OTHER->value:
        return 'other';
        break;
    }
  }

  //EIGER SECTION
  public function model()
  {
    return $this->morphTo();
  }
  public function province()
  {
    return $this->belongsToModel('Province');
  }
  public function district()
  {
    return $this->belongsToModel('District');
  }
  public function subdistrict()
  {
    return $this->belongsToModel('Subdistrict');
  }
  public function village()
  {
    return $this->belongsToModel('Village');
  }
  //END EIGER SECTION
}
