<?php

namespace Hanafalah\LaravelPermission\Models\Permission;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\LaravelPermission\Enums\{
    Permission\Type
};

use Illuminate\Support\Str;
use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelPermission\Resources\Permission\ViewPermission;

class Permission extends BaseModel
{
    use HasProps;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'alias',
        'root',
        'type',
        'guard_name',
        'visibility'
    ];

    protected static function booted(): void
    {
        parent::booted();
        static::addGlobalScope('visible', function ($query) {
            $query->where('visibility', true);
        });
        static::creating(function ($query) {
            if (!isset($query->guard_name)) $query->guard_name = "api";
            if (!isset($query->visibility)) $query->visibility = true;
            $route = Route::getRoutes()->getByName($query->alias);
            if (isset($route)) {
                $query->method = $route->methods[0] ?? '';
                $query->slug   = $route->uri;
                $query->prefix = $route->action['prefix'];
            }
        });
        static::created(function ($query) {
            static::rootGenerator($query);
        });
        static::updated(function ($query) {
            static::rootGenerator($query);
        });
    }

    public function toViewApi()
    {
        return new ViewPermission($this);
    }

    public function toShowApi()
    {
        return new ViewPermission($this);
    }

    protected static function rootGenerator($query, mixed $dirties = null)
    {
        $dirties ??= $query->getDirtyRoot();
        if (static::isHasRoot($query) && static::needRooting()) {
            if (($query->wasRecentlyCreated && !isset($query->root)) || $query->isDirty($dirties)) {
                if (isset($query->directory)) {
                    $query->directory = rtrim($query->alias, '.');
                    $query->directory = rtrim($query->alias, '.index');
                    $query->directory = rtrim($query->alias, '.show');
                    $directories      = explode('.', $query->directory);
                    foreach ($directories as &$directory) $directory = Str::kebab($directory);
                    $query->directory = implode('/', $directories);
                    $query->directory = Str::replace('/index', '', $query->directory);
                    $query->directory = Str::replace('/show', '', $query->directory);
                }
                if (isset($query->parent_id)) {
                    $parent = (new static)->find($query->parent_id);
                    $rootId = $parent->root . "." . $query->id;
                }
                $query->root = $rootId ?? $query->id;
                $query->saveQuietly();
            }
        }
    }

    public function scopeAlias($builder, mixed $alias, string $alias_name = 'alias')
    {
        return $builder->where(function ($query) use ($alias, $alias_name) {
            $aliases = $this->mustArray($alias);
            foreach ($aliases as $alias) $query->orWhere($alias_name, $alias);
        });
    }

    public function scopeAliases($builder, mixed $alias, string $alias_name = 'alias')
    {
        $builder->where(function ($query) use ($alias, $alias_name) {
            $aliases = $this->mustArray($alias);
            foreach ($aliases as $alias) {
                $query->orWhere(function ($query) use ($alias_name, $alias) {
                    $query->where($alias_name, $alias)
                        ->orWhereLike($alias_name, $alias . '%');
                });
            }
        });
    }

    public function scopeAsModule($builder)
    {
        return $builder->where("type", Type::MODULE->value);
    }

    public function scopeAsPermission($builder)
    {
        return $builder->where("type", Type::PERMISSION->value);
    }
    public function scopeAsMenu($builder)
    {
        return $builder->where("type", Type::MENU->value);
    }
    public function scopeShowInAcl($builder)
    {
        return $builder->where("props->show_in_acl", true);
    }

    public function scopeCheckAccess($builder, $model_id, $model_type = 'Role')
    {
        $builder->select('*');
        if ($model_type == 'Role') {
            $model = $this->RoleHasPermissionModel();
            $key   = "role_id = ?";
            $bindings = [$model_id];
        } else {
            $model = $this->ModelHasPermissionModel();
            $key   = "CAST(model_id AS CHAR) = '?' AND model_type = '?'";
            $bindings = [$model_id, $model_type];
        }
        $table_name = $model->getTableName();
        $builder->selectRaw("permissions.*,CASE WHEN EXISTS (SELECT permission_id FROM $table_name WHERE $key AND permission_id = permissions.id) THEN 1 ELSE 0 END as access", $bindings);
        return $builder;
    }

    //EIGER SECTION
    public function modelHasPermission()
    {
        return $this->hasOneModel('ModelHasPermission');
    }

    public function roleHasPermission()
    {
        return $this->hasOneModel('RoleHasPermission');
    }

    public function recursiveChilds()
    {
        return $this->hasManyModel('Permission', 'parent_id')->when(isset(request()->role_id), function ($query) {
            $query->checkAccess(request()->role_id);
        })->with('recursiveChilds');
    }
}
