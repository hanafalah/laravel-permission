<?php

namespace Zahzah\ModuleRegional\Models\Maps;

use Zahzah\LaravelSupport\Models\BaseModel;

class ModelHasCoordinate extends BaseModel{
    protected $fillable = ['id','model_id','model_type','coordinate'];

    //EIGER SECTION
    public function model(){return $this->morphTo();}
    //END EIGER SECTION
}