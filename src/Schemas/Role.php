<?php

namespace Hanafalah\LaravelPermission\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelPermission\Contracts\Role as ContractsRole;
use Hanafalah\LaravelPermission\Data\RoleDTO;
use Hanafalah\LaravelPermission\Resources\Role\{ViewRole, ShowRole};
use Hanafalah\LaravelSupport\Supports\PackageManagement;

class Role extends PackageManagement implements ContractsRole
{
    protected string $__entity = 'Role';
    public static $role_model;

    protected array $__resources = [
        'view' => ViewRole::class,
        'show' => ShowRole::class
    ];

    public function prepareViewRoleList(?array $attributes = null): Collection
    {
        $attributes ??= request()->all();

        $role = $this->role()->get();

        return static::$role_model = $role;
    }

    public function viewRoleList(): array
    {
        return $this->transforming($this->__resources['view'], function () {
            return $this->prepareViewRoleList();
        });
    }

    public function showUsingRelation(): array
    {
        return [
            'permissions'
        ];
    }

    public function getRoleModel(): mixed
    {
        return static::$role_model;
    }

    public function prepareShowRole(?Model $model = null, ?array $attributes = null): Model
    {
        $attributes ??= request()->all();

        $model ??= $this->getRoleModel();
        if (!isset($model)) {
            $id = $attributes['id'] ?? null;
            if (!isset($id)) throw new \Exception("Data tidak dapat diproses");

            $model = $this->role()->with($this->showUsingRelation())->findOrFail($id);
        } else {
            $model->load($this->showUsingRelation());
        }

        return static::$role_model = $model;
    }

    public function showRole(?Model $model = null): array
    {
        return $this->transforming($this->__resources['show'], function () use ($model) {
            return $this->prepareShowRole($model);
        });
    }

    public function prepareStoreRole(RoleDTO $role_dto): Model
    {
        $guard = (isset($role_dto->id)) ? ['id' => $role_dto->id] : ['name' => $role_dto->name];
        $role  = $this->RoleModel()->updateOrCreate($guard, [
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

    public function storeRole(?array $attributes = null): array
    {
        return $this->transaction(function () {
            $attributes ??= request()->all();

            return $this->showRole($this->prepareStoreRole(new RoleDTO(
                $attributes['id'] ?? null,
                $attributes['name'],
                $attributes['permission_id'] ?? null,
                $attributes['permissions'] ?? null
            )));
        });
    }

    public function prepareDeleteRole(?array $attributes = null): bool
    {
        $attributes ??= request()->all();

        if (!isset($attributes['id'])) throw new \Exception("Data tidak dapat diproses");

        $role = $this->RoleModel()->findOrFail($attributes['id']);
        return $role->delete();
    }

    public function deleteRole(): bool
    {
        return $this->transaction(function () {
            return $this->prepareDeleteRole();
        });
    }

    public function role(mixed $conditionals = null): Builder
    {
        $this->booting();
        return $this->RoleModel()->when(isset(request()->parent_id), function ($query) {
            $query->where('parent_id', request()->parent_id);
        })->withParameters()->conditionals($this->mergeCondition($conditionals ?? []))->orderBy('name', 'asc');
    }

    public function addOrChange(?array $attributes = []): self
    {
        $this->updateOrCreate($attributes);
        return $this;
    }
}
