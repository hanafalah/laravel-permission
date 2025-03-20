<?php

namespace Zahzah\LaravelPermission\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Zahzah\LaravelSupport\Contracts\DataManagement;

interface Permission extends DataManagement{
    public function prepareStorePermission(? array $attributes = null): Model;
    public function prepareViewPermissionList(? array $attributes = null): Collection;
    public function viewPermissionList(): array;
    public function getPermissionModel(): mixed;
    public function showUsingRelation(): array;
    public function prepareShowPermission(? Model $model = null, ? array $attributes = null): Model;
    public function showPermission(? Model $model = null): array;
    public function permission(mixed $conditionals = null): Builder;
    public function addOrChange(? array $attributes=[]): self;
    
}