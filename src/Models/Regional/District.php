<?php

namespace Zahzah\ModuleRegional\Models\Regional;

class District extends Location
{
    public $timestamps    = false;
    protected $fillable   = ['province_id'];

    public function district(){return $this->hasOneModel('District');}
    public function districts(){return $this->hasManyModel('District');}
}
