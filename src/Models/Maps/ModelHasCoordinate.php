<?php

namespace Hanafalah\ModuleRegional\Models\Maps;

use Hanafalah\LaravelSupport\Models\BaseModel;

class ModelHasCoordinate extends BaseModel
{
    protected $fillable = ['id', 'model_id', 'model_type', 'coordinate'];

    public function model(){return $this->morphTo();}
}
