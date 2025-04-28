<?php

namespace Hanafalah\LaravelPermission\Contracts\Schemas;

use Hanafalah\LaravelPermission\Data\RoleData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;

/**
 * @see \Hanafalah\LaravelPermission\Schemas\Role
 * @method bool deleteRole()
 * @method bool prepareDeleteRole(? array $attributes = null)
 * @method mixed getRole()
 * @method ?Model prepareShowRole(?Model $model = null, ?array $attributes = null)
 * @method array showRole(?Model $model = null)
 * @method Collection prepareViewRoleList()
 * @method array viewRoleList()
 * @method LengthAwarePaginator prepareViewRolePaginate(PaginateData $paginate_dto)
 * @method array viewRolePaginate(?PaginateData $paginate_dto = null)
 * @method array storeRole(?RoleData $funding_dto = null)
 */
interface Role extends DataManagement
{
    public function prepareStoreRole(RoleData $role_dto): Model;
    public function role(mixed $conditionals = null): Builder;
}
