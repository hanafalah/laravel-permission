<?php

namespace Hanafalah\LaravelPermission\Concerns;

use Hanafalah\LaravelHasProps\Models\Scopes\HasCurrentScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasRole
{
    use RoleMutator;

    public function roles(){
        return $this->belongsToManyModel(
            'Role',
            'ModelHasRole',
            'model_id',
            $this->RoleModel()->getForeignKey()
        )->where('model_type', $this->getMorphClass())
            ->select($this->RoleModel()->getTable() . '.*', $this->ModelHasRoleModel()->getTable() . '.current')
            ->withoutGlobalScopes([HasCurrentScope::class]);
    }

    public function role(){
        $role_key     = $this->RoleModel()->getKeyName();
        $role_foreign = $this->RoleModel()->getForeignKey();
        return $this->hasOneThroughModel(
            'Role',
            'ModelHasRole',
            'model_id',
            $role_key,
            $this->getKeyName(),
            $role_foreign
        )->where('model_type', $this->getMorphClass())
            ->select($this->RoleModel()->getTable() . '.*', $this->ModelHasRoleModel()->getTable() . '.current')
            ->where('current', 1);
    }

    public function modelHasRole(){
        return $this->morphOneModel('ModelHasRole', 'model')->withoutGlobalScopes();
    }

    public function syncRoles(array $roles = []): void{
        $roles = $this->readRoles($roles);
        $this->roles()->detach();
        $this->addRole($roles,['current' => 0]);
        $role = end($roles);
        $model_has_role = $this->modelHasRole()
            ->where('model_id', $this->getKey())
            ->where('model_type', $this->getMorphClass())
            ->where('role_id', $role)->first();
        $model_has_role->current = 1;
        $model_has_role->save();
    }

    public function switchRoleTo(object|string $role): Model{
        $role = $this->readRole($role,true);
        $model_has_role = $this->modelHasRole()
            ->where('model_id', $this->getKey())
            ->where('model_type', $this->getMorphClass())
            ->where('role_id', $role->getKey())->first();
        $model_has_role->current = 1;
        $model_has_role->save();
        if (in_array('props',$this->getFillable())){
            $this->prop_role = [
                'id' => $role->getKey(),
                'name' => $role->name
            ];
            $this->save();
        }
        return $role;
    }

    public function addRole(object|array|string $role, ?array $attributes = []): void{
        $create = [
            'model_type' => $this->getMorphClass(),
            'current'    => $attributes['current'] ?? 1,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $this->roles()->attach(is_object($role) || is_array($role) ? $role : $this->readRole($role, true), $create);
    }

    public function flushRoles(): void{
        $this->roles()->detach();
    }

    public function removeRole(object|string $role): void{
        $this->roles()->detach($this->readRole($role));
    }
}
