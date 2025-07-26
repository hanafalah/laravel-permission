<?php

namespace Hanafalah\LaravelPermission\Models\Permission;

use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class ModelHasPermission extends BaseModel
{
    protected $fillable   = [
        'id',
        'permission_id',
        'model_id',
        'model_type'
    ];
    
    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [];
    }

    public function permission(){return $this->belongsToModel('Permission');}
    public function model(){return $this->morphTo('model');}
}
