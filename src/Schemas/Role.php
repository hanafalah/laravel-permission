<?php

namespace Hanafalah\LaravelPermission\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelPermission\Contracts\Schemas\Role as ContractsRole;
use Hanafalah\LaravelPermission\Data\RoleData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;

class Role extends PackageManagement implements ContractsRole
{
    protected string $__entity = 'Role';
    public static $role_model;

    public function prepareStoreRole(RoleData $role_dto): Model{
        $guard = (isset($role_dto->id)) ? ['id' => $role_dto->id] : ['name' => $role_dto->name];
        $role  = $this->role()->updateOrCreate($guard, [
                    'name' => $role_dto->name
                ]);

        if (isset($role_dto->permission_id) || isset($role_dto->permissions)) {
            $permissions = $role_dto->permission_id ?? $role_dto->permissions;
            $permissions = $this->mustArray($permissions);
            if (count($permissions) > 0) {
                $role->syncPermissions($permissions, true);
                $role->setAttribute('permissions_ids', $permissions);
            } else {
                $role->flushPermissions();
                $role->setAttribute('permissions_ids', []);
            }
            $role->save();
        }

        return static::$role_model = $role;
    }

    public function role(mixed $conditionals = null): Builder{
        return $this->RoleModel()->withParameters()
                    ->conditionals($this->mergeCondition($conditionals ?? []))
                    ->when(isset(request()->parent_id), function ($query) {
                        $query->where('parent_id', request()->parent_id);
                    })
                    ->orderBy('name', 'asc');
    }
}
