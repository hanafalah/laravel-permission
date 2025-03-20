<?php

namespace Zahzah\LaravelPermission\Concerns;

use Illuminate\Support\Facades\DB;
use Zahzah\LaravelHasProps\Models\Scopes\HasCurrentScope;

trait HasRole
{
    use RoleMutator;

    public function roles(){
        return $this->belongsToManyModel(
            'Role',
            'ModelHasRole',
            'model_id',
            $this->RoleModel()->getForeignKey()
        )->where('model_type',$this->getMorphClass())
        ->select($this->RoleModel()->getTable().'.*',$this->ModelHasRoleModel()->getTable().'.current')
        ->withoutGlobalScopes([HasCurrentScope::class]);
    }

    public function role(){
        $role_key     = $this->RoleModel()->getKeyName();
        $role_foreign = $this->RoleModel()->getForeignKey();
        return $this->hasOneThroughModel(
            'Role', 'ModelHasRole',
            'model_id',$role_key,
            $this->getKeyName(),
            $role_foreign
        )->where('model_type',$this->getMorphClass())
        ->select($this->RoleModel()->getTable().'.*',$this->ModelHasRoleModel()->getTable().'.current')
        ->where('current',1);
    }

    public function modelHasRole(){
        return $this->morphOneModel('ModelHasRole','model')->withoutGlobalScopes();
    }

    public function syncRoles(array $roles = []): void{
        $roles = $this->readRoles($roles);
        $this->roles()->detach();
        $this->roles()->attach($roles,[
            'model_type' => $this->getMorphClass(),
            'current'    => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $role = end($roles);
        $model_has_role = $this->modelHasRole()
                               ->where('model_id',$this->getKey())
                               ->where('model_type',$this->getMorphClass())
                               ->where('role_id',$role)->first();
        $model_has_role->current = 1;
        $model_has_role->save();
    }

    public function addRole(object|string $role): void{
        $this->roles()->attach(is_object($role) ? $role : $this->readRole($role,true),[
            'model_type' => $this->getMorphClass(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function flushRoles(): void{
        $this->roles()->detach();
    }

    public function removeRole(object|string $role): void{
        $this->roles()->detach($this->readRole($role));
    }

}
