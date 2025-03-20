<?php

namespace Hanafalah\LaravelPermission\Concerns;

use Hanafalah\LaravelPermission\Models\Role\Role;

trait HasPermission
{
    use PermissionMutator;

    public function permissions()
    {
        $permission_key = $this->PermissionModel()->getForeignKey();

        if (\is_subclass_of($this, Role::class)) {
            return $this->belongsToManyModel(
                'Permission',
                'RoleHasPermission',
                $this->getForeignKey(),
                $permission_key
            );
        } else {
            return $this->belongsToManyModel(
                'Permission',
                'ModelHasPermission',
                'model_id',
                $permission_key
            )->where('model_type', $this->getMorphClass());
        }
    }

    public function permission()
    {
        $permission_key = $this->PermissionModel()->getKeyName();
        $permission_foreign = $this->PermissionModel()->getForeignKey();
        if (\is_subclass_of($this, Role::class)) {
            return $this->hasOneThroughModel(
                'Permission',
                'RoleHasPermission',
                $this->getForeignKey(),
                $permission_key,
                $this->getKeyName(),
                $permission_foreign
            );
        } else {
            return $this->hasOneThroughModel(
                'Permission',
                'ModelHasPermission',
                'model_id',
                $permission_key,
                $this->getKeyName(),
                $permission_foreign
            )->where('model_type', $this->getMorphClass());
        }
    }

    public function syncPermissionsById(array $permissions = []): void
    {
        $this->syncPermissions($permissions, true);
    }

    public function syncPermissions(array $permissions = [], bool $by_id = false): void
    {
        if (!$by_id) $permissions = $this->readPermissions($permissions);
        $this->permissions()->detach();
        foreach ($permissions as $permission) {
            if (\is_subclass_of($this, Role::class)) {
                $this->roleHasPermissions()->updateOrCreate([
                    'role_id'       => $this->getKey(),
                    'permission_id' => $permission
                ]);
            } else {
                $this->modelHasPermissions()->updateOrCreate([
                    'model_id'      => $this->getKey(),
                    'model_type'    => $this->getMorphClass(),
                    'permission_id' => $permission
                ]);
            }
        }
    }

    public function addPermission(object|string $permission): void
    {
        if ($this->permissions()->where('alias', $permission)->first() === null) {
            $this->permissions()->attach($this->readPermission($permission, true), [
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    public function flushPermissions(): void
    {
        $this->permissions()->detach();
    }

    public function removePermission(object|string $permission): void
    {
        $this->permissions()->detach($this->readPermission($permission));
    }

    public function roleHasPermissions()
    {
        return $this->hasManyModel('RoleHasPermission');
    }

    public function modelHasPermissions()
    {
        return $this->morphManyModel('ModelHasPermission', 'model');
    }
}
