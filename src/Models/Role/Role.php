<?php

namespace Hanafalah\LaravelPermission\Models\Role;

use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelPermission\Concerns\HasPermission;
use Hanafalah\LaravelPermission\Resources\Role\{ViewRole, ShowRole};
use Hanafalah\LaravelSupport\Models\BaseModel;

class Role extends BaseModel
{
    use SoftDeletes, HasPermission, HasProps;

    protected $list  = ['id', 'parent_id', 'name', 'props'];
    protected $casts = [
        'name' => 'string'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('order_by_name', function ($query) {
            $query->orderBy('name', 'asc');
        });
        static::deleting(function ($query) {
            $query->flushPermissions();
        });
    }

    public function toViewApi()
    {
        return new ViewRole($this);
    }

    public function toShowApi()
    {
        return new ShowRole($this);
    }

    public function modelHasRole()
    {
        return $this->hasOneModel('ModelHasRole');
    }
    public function modelHasRoles()
    {
        return $this->hasManyModel('ModelHasRole');
    }
    public function roleHasPermission()
    {
        return $this->hasOneModel('RoleHasPermission');
    }
    public function roleHasPermissions()
    {
        return $this->hasManyModel('RoleHasPermission');
    }
}
