<?php

namespace Zahzah\LaravelPermission\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Zahzah\LaravelPermission\Data\RoleDTO;
use Zahzah\LaravelSupport\Contracts\DataManagement;

interface Role extends DataManagement{
    public function prepareViewRoleList(? array $attributes = null): Collection;
    public function viewRoleList(): array;
    public function showUsingRelation(): array;
    public function getRoleModel(): mixed;
    public function prepareShowRole(? Model $model = null, ? array $attributes = null): Model;
    public function showRole(? Model $model = null): array;
    public function prepareStoreRole(RoleDTO $role_dto): Model;
    public function storeRole(? array $attributes = null): array;
    public function prepareDeleteRole(? array $attributes = null): bool;
    public function deleteRole(): bool;
    public function role(mixed $conditionals = null): Builder;
    public function addOrChange(? array $attributes=[]): self;    
    
}