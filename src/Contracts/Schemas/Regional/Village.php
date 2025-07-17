<?php

namespace Hanafalah\ModuleRegional\Contracts\Schemas\Regional;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;

/**
 * @see \Hanafalah\ModuleRegional\Schemas\Village
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method array storeVillage(?VillageData $rab_work_list_dto = null)
 * @method bool deleteVillage()
 * @method bool prepareDeleteVillage(? array $attributes = null)
 * @method mixed getVillage()
 * @method ?Model prepareShowVillage(?Model $model = null, ?array $attributes = null)
 * @method array showVillage(?Model $model = null)
 * @method array viewVillageList()
 * @method Collection prepareViewVillageList(? array $attributes = null)
 * @method LengthAwarePaginator prepareViewVillagePaginate(PaginateData $paginate_dto)
 * @method array viewVillagePaginate(?PaginateData $paginate_dto = null)
 * @method Builder function village(mixed $conditionals = null)
 */
interface Village extends DataManagement{
}