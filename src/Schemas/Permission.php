<?php

namespace Zahzah\LaravelPermission\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Zahzah\LaravelPermission\Contracts\Permission as ContractsPermission;
use Zahzah\LaravelPermission\Resources\Permission\ViewPermission;
use Zahzah\LaravelSupport\Supports\PackageManagement;

class Permission extends PackageManagement implements ContractsPermission{
    protected array $__guard   = ['id','parent_id','alias']; 
    protected array $__add     = ['name','slug', 'root','type','guard_name','visibility'];
    protected string $__entity = 'Permission';
    public static $permission_model;

    protected array $__resources = [
        'view' => ViewPermission::class,
        'show' => ViewPermission::class
    ];

    public function prepareStorePermission(? array $attributes = null): Model{
        $attributes ??= request()->all();
        foreach ($attributes as $attribute) {
            $permission = $this->addPermission($attribute);
        }
        return $permission;
    }

    public function prepareViewPermissionList(? array $attributes = null): Collection{
        $attributes ??= request()->all();

        $permission = $this->permission()->when(isset(request()->role_id),function($query){
            $query->checkAccess(request()->role_id);
        })->whereNull('parent_id')->with('recursiveChilds')->get();

        return static::$permission_model = $permission;
    }

    public function viewPermissionList(): array{
        return $this->transforming($this->__resources['view'],function(){
            return $this->prepareViewPermissionList();
        });
    }

    public function getPermissionModel(): mixed{
        return static::$permission_model;
    }

    public function showUsingRelation(): array{
        return [];
    }

    public function prepareShowPermission(? Model $model = null, ? array $attributes = null): Model{
        $attributes ??= request()->all();

        if (isset($model) && $model instanceof Collection) {
            foreach ($model as $key => $new_model) {
                $model[$key] = $this->prepareShowPermission($new_model,$attributes);
            }
        }else{
            $model ??= $this->getPermissionModel();
            if (!isset($model)){
                $id = $attributes['id'] ?? null;
                if (!isset($id)) throw new \Exception("Data tidak dapat diproses");
    
                $model = $this->permission()->with($this->showUsingRelation())->findOrFail($id);
            }else{
                $model->load($this->showUsingRelation());
            }
        }
        return static::$permission_model = $model;
    }

    public function showPermission(? Model $model = null): array{
        return $this->transforming($this->__resources['view'],function() use ($model){
            return $this->prepareShowPermission($model);
        });
    }

    private function addPermission(array $attributes){
        $permission = $this->PermissionModel()->firstOrCreate([
            'parent_id' => $attributes['parent_id'] ?? null,
            'alias'     => $attributes['alias']
        ],[
            'name'      => $attributes['name'],
            'type'      => $attributes['type']
        ]);
        if (isset($attributes['props'])){
            foreach ($attributes['props'] as $key => $prop) {
                $permission->{$key} = $prop;
            }
            $permission->save();
        }
        if (isset($attributes['childs']) && count($attributes['childs']) > 0) {
            foreach ($attributes['childs'] as $child) {
                $child['parent_id'] = $permission->getKey();
                $this->addPermission($child);
            }
        }
        return $permission;
    }

    public function permission(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->PermissionModel()->conditionals($conditionals)->orderBy('name','asc');
    }

    public function addOrChange(? array $attributes=[]): self{
        $this->updateOrCreate($attributes);
        return $this;
    }
}