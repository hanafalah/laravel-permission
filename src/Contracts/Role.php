<?php

namespace Hanafalah\LaravelPermission\Contracts;

use Hanafalah\LaravelPermission\Data\RoleData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\DataManagement;

interface Role extends DataManagement
{
    public function showUsingRelation(): array;
    public function viewUsingRelation(): array;
    public function getRoleModel(): mixed;
    public function prepareViewRoleList(?array $attributes = null): Collection;
    public function viewRoleList(): array;
    public function prepareShowRole(?Model $model = null, ?array $attributes = null): Model;
    public function showRole(?Model $model = null): array;
    public function prepareStoreRole(RoleData $role_dto): Model;
    public function storeRole(?RoleData $role_dto = null): array;
    public function prepareDeleteRole(?array $attributes = null): bool;
    public function deleteRole(): bool;
    public function role(mixed $conditionals = null): Builder;
}
