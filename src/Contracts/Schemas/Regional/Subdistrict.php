<?php

namespace Hanafalah\ModuleRegional\Contracts\Schemas\Regional;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @see \Hanafalah\ModuleRegional\Schemas\Subdistrict
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method array storeSubdistrict(?SubdistrictData $rab_work_list_dto = null)
 * @method bool deleteSubdistrict()
 * @method bool prepareDeleteSubdistrict(? array $attributes = null)
 * @method mixed getSubdistrict()
 * @method ?Model prepareShowSubdistrict(?Model $model = null, ?array $attributes = null)
 * @method array showSubdistrict(?Model $model = null)
 * @method array viewSubdistrictList()
 * @method Collection prepareViewSubdistrictList(? array $attributes = null)
 * @method LengthAwarePaginator prepareViewSubdistrictPaginate(PaginateData $paginate_dto)
 * @method array viewSubdistrictPaginate(?PaginateData $paginate_dto = null)
 * @method Builder function subdistrict(mixed $conditionals = null)
 */
interface Subdistrict extends DataManagement{
}