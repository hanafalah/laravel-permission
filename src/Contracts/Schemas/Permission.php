<?php

namespace Hanafalah\LaravelPermission\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;

/**
 * @see \Hanafalah\LaravelPermission\Schemas\Permission
 * @method self conditionals(mixed $conditionals)
 * @method bool deletePermission()
 * @method bool prepareDeletePermission(? array $attributes = null)
 * @method mixed getPermission()
 * @method array viewPermissionList()
 * @method array showPermission(?Model $model = null)
 * @method LengthAwarePaginator prepareViewPermissionPaginate(PaginateData $paginate_dto)
 * @method array viewPermissionPaginate(?PaginateData $paginate_dto = null)
 * @method array storePermission(?PermissionData $Permission_dto = null)
 */
interface Permission extends DataManagement
{
    public function prepareStorePermission(?array $attributes = null): array;
    public function prepareViewPermissionList(?array $attributes = null): Collection;
    public function prepareViewMenuList(?array $attributes = null): Collection;
    public function viewMenuList(): array;
    public function prepareShowPermission(?Model $model = null, ?array $attributes = null): Model;
    public function permission(mixed $conditionals = null): Builder;
}
