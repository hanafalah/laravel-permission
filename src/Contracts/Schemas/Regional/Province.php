<?php

namespace Hanafalah\ModuleRegional\Contracts\Schemas\Regional;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @see \Hanafalah\ModuleRegional\Schemas\Province
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method array storeProvince(?ProvinceData $rab_work_list_dto = null)
 * @method bool deleteProvince()
 * @method bool prepareDeleteProvince(? array $attributes = null)
 * @method mixed getProvince()
 * @method ?Model prepareShowProvince(?Model $model = null, ?array $attributes = null)
 * @method array showProvince(?Model $model = null)
 * @method array viewProvinceList()
 * @method Collection prepareViewProvinceList(? array $attributes = null)
 * @method LengthAwarePaginator prepareViewProvincePaginate(PaginateData $paginate_dto)
 * @method array viewProvincePaginate(?PaginateData $paginate_dto = null)
 * @method Builder function province(mixed $conditionals = null)
 */
interface Province extends DataManagement{}