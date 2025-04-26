<?php

namespace Hanafalah\ModuleRegional\Contracts\Schemas\Regional;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;

/**
 * @see \Hanafalah\ModuleRegional\Schemas\District
 * @method self conditionals(mixed $conditionals)
 * @method array storeDistrict(?DistrictData $rab_work_list_dto = null)
 * @method bool deleteDistrict()
 * @method bool prepareDeleteDistrict(? array $attributes = null)
 * @method mixed getDistrict()
 * @method ?Model prepareShowDistrict(?Model $model = null, ?array $attributes = null)
 * @method array showDistrict(?Model $model = null)
 * @method array viewDistrictList()
 * @method Collection prepareViewDistrictList(? array $attributes = null)
 * @method LengthAwarePaginator prepareViewDistrictPaginate(PaginateData $paginate_dto)
 * @method array viewDistrictPaginate(?PaginateData $paginate_dto = null)
 * @method Builder function district(mixed $conditionals = null)
 */
interface District extends DataManagement{}