<?php

namespace Hanafalah\ModuleRegional\Models\Regional;

use Hanafalah\LaravelHasProps\Concerns\HasProps;

class Village extends Location
{
    protected $fillable = ['province_id', 'district_id', 'subdistrict_id', 'post_code'];

    public function subdistrict(){return $this->belongsToModel('Subdistrict');}
}
