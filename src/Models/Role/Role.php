<?php

namespace Hanafalah\LaravelPermission\Models\Role;

use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelPermission\Concerns\HasPermission;
use Hanafalah\LaravelPermission\Resources\Role\{ViewRole, ShowRole};
use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Role extends BaseModel
{
    use SoftDeletes, HasPermission, HasProps, HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
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

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [
            'permissions' => function($query){
                if (isset(request()->role_id)){
                    $query->checkAccess(request()->role_id);
                }
                $query->whereNull('parent_id')->with('recursiveChilds');
            }
        ];
    }

    public function getViewResource(){return ViewRole::class;}
    public function getShowResource(){return ShowRole::class;}

    public function modelHasRole(){return $this->hasOneModel('ModelHasRole');}
    public function modelHasRoles(){return $this->hasManyModel('ModelHasRole');}
    public function roleHasPermission(){return $this->hasOneModel('RoleHasPermission');}
    public function roleHasPermissions(){return $this->hasManyModel('RoleHasPermission');}
}
