<?php

namespace Zahzah\LaravelPermission\Concerns;

use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Str;
use Zahzah\LaravelPermission\Models\Role\Role;

trait RoleMutator{
    public function readRoles(array $roles, bool $as_object = false): array{
        $new_roles = [];
        $i = 0;
        $this->reduceArray($roles,function($carry,$role) use (&$new_roles,$as_object,$i){
            $collect = collect($this->readRole($role,$as_object))->flatten();
            if(!$collect->isEmpty()){
                $new_roles = $this->mergeArray($new_roles,...$collect);
            }
        });
        return $new_roles;
    }

    public function readRole(string $role,bool $as_object = false): null|array|string|Collection|Role{
        if (is_object($role) && $role instanceof Role && $as_object){
            return $role;
        }
        $role = $this->RoleModel()->where((is_numeric($role)) ? $this->RoleModel()->getKeyName() : 'name',$role)->first();
        return ($as_object) ? $role : $role->getKey();
    }

    public function getRole(string|object $role): Collection|Role{
        return $this->readRole($role,true);
    }

    public function hasRole(object|string $role): bool{
        return $this->readRole($role,true) !== null;
    }

    public function hasRoles(array $roles): bool{
        $exists = true;
        foreach ($roles as $role){
            $exists = $this->hasRole($role);
            if (!$exists){
                break;
            }
        }
        return $exists;
    }
}