<?php

namespace Zahzah\LaravelPermission\Models\Role;

use Zahzah\LaravelSupport\Models\BaseModel;

class RoleHasPermission extends BaseModel{
    
    protected $list = ['id','role_id','permission_id'];

    public function role(){return $this->belongsToModel('Role');}
    public function permission(){return $this->belongsToModel('Permission');}
}