<?php

namespace Zahzah\LaravelPermission\Models\Permission;

use Zahzah\LaravelSupport\Models\BaseModel;

class ModelHasPermission extends BaseModel
{
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'id','permission_id','model_id','model_type'    
    ];

    public function permission(){return $this->belongsToModel('Permission');}
    public function model(){return $this->morphTo('model');}
}

