<?php

namespace Hanafalah\LaravelPermission\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelPermission\Contracts\Schemas\{
    Permission as ContractsPermission,
    Menu
};
use Hanafalah\LaravelPermission\Contracts\Data\PermissionData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;

class Permission extends PackageManagement implements ContractsPermission,Menu
{
    protected string $__entity = 'Permission';
    public static $permission_model;

    public function getPermission(): mixed{
        return static::$permission_model;
    }

    public function prepareStorePermission(?array $attributes = null): array{        
        $attributes ??= request()->all();
        $permissions = [];
        foreach ($attributes as $attribute) {
            $permissions[] = $this->addPermission($this->requestDTO(PermissionData::class,$attribute));
        }
        return $permissions;
    }

    public function prepareViewPermissionList(?array $attributes = null): Collection{
        $attributes ??= request()->all();

        $permission = $this->permission()->whereNull('parent_id')->with('recursiveChilds')->get();

        return static::$permission_model = $permission;
    }

    public function viewPermissionList(): array{
        return $this->viewEntityResource(function(){
            return $this->prepareViewPermissionList();
        });
    }

    public function prepareViewMenuList(?array $attributes = null): Collection{
        $attributes ??= request()->all();
        
        if (!isset($attributes['role_id'])) throw new \Exception('Role id not found');

        $permission = $this->permission()->whereNull('parent_id')->with('recursiveMenus')
                            ->whereHas('roleHasPermission',function($query) use ($attributes){
                                $query->where('role_id',$attributes['role_id']);
                            })->asMenu()->get();
        return static::$permission_model = $permission;
    }

    public function viewMenuList(): array{
        return $this->transforming($this->usingEntity()->getViewMenuResource(),function(){
            return $this->prepareViewMenuList();
        });
    }

    public function prepareShowPermission(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();

        if (isset($model) && $model instanceof Collection) {
            foreach ($model as $key => $new_model) {
                $model[$key] = $this->prepareShowPermission($new_model, $attributes);
            }
        } else {
            $model ??= $this->getPermission();
            if (!isset($model)) {
                $id = $attributes['id'] ?? null;
                if (!isset($id)) throw new \Exception("Data tidak dapat diproses");

                $model = $this->permission()->with($this->showUsingRelation())->findOrFail($id);
            } else {
                $model->load($this->showUsingRelation());
            }
        }
        return static::$permission_model = $model;
    }

    public function showPermission(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowPermission($model);
        });
    }

    private function addPermission(PermissionData $permission_dto){
        $permission = $this->PermissionModel()->firstOrCreate([
            'parent_id' => $permission_dto->parent_id ?? null,
            'alias'     => $permission_dto->alias
        ], [
            'name'      => $permission_dto->name,
            'type'      => $permission_dto->type
        ]);
        $permission->refresh();
        if (isset($permission_dto->props)) {
            foreach ($permission_dto->props as $key => $prop) {
                $permission->{$key} = $prop;
            }
            $permission->save();
        }
        if (isset($permission_dto->childs) && count($permission_dto->childs) > 0) {
            foreach ($permission_dto->childs as $child) {
                $child->parent_id = $permission->getKey();
                $this->addPermission($child);
            }
        }
        return $permission;
    }

    public function permission(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->PermissionModel()->conditionals($this->mergeCOndition($conditionals ?? []))
                    ->when(isset(request()->role_id), function ($query) {
                        $query->checkAccess(request()->role_id);
                    })
                    ->withParameters()->orderBy('name', 'asc');
    }
}
