<?php

namespace Hanafalah\ModuleRegional\Models\Regional;

use Hanafalah\LaravelHasProps\Concerns\HasProps;

class Village extends Location
{
    public $timestamps  = false;
    protected $fillable = ['province_id', 'district_id', 'subdistrict_id', 'post_code'];

    //EIGER SECTION
    public function subdistrict()
    {
        return $this->belongsToModel('Subdistrict');
    }
    //END EIGER SECTION
}
