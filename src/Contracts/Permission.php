<?php

namespace Hanafalah\LaravelPermission\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\DataManagement;

interface Permission extends DataManagement
{
    public function getPermissionModel(): mixed;
    public function showUsingRelation(): array;
    public function getPermission(): mixed;
    public function prepareStorePermission(?array $attributes = null): Model;
    public function prepareViewPermissionList(?array $attributes = null): Collection;
    public function viewPermissionList(): array;
    public function prepareShowPermission(?Model $model = null, ?array $attributes = null): Model;
    public function showPermission(?Model $model = null): array;
    public function permission(mixed $conditionals = null): Builder;
    
}
