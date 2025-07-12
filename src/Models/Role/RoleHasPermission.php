<?php

namespace Hanafalah\LaravelPermission\Models\Role;

use Hanafalah\LaravelSupport\Models\BaseModel;

class RoleHasPermission extends BaseModel
{

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected $list = ['id', 'role_id', 'permission_id'];

    public function role(){return $this->belongsToModel('Role');}
    public function permission(){return $this->belongsToModel('Permission');}
}
