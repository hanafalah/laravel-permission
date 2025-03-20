<?php

namespace Hanafalah\ModuleRegional\Models\Regional;

class Province extends Location
{
    public $timestamps = false;
    public function district()
    {
        return $this->hasOneModel('District');
    }
    public function districts()
    {
        return $this->hasManyModel('District');
    }
    public function village()
    {
        return $this->hasOneModel('Village');
    }
    public function villages()
    {
        return $this->hasManyModel('Village');
    }
}
