<?php

namespace Hanafalah\ModuleRegional\Contracts\Schemas\Citizenship;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;

/**
 * @see \Hanafalah\ModuleRegional\Schemas\Country
 * @method self conditionals(mixed $conditionals)
 * @method array storeCountry(?CountryData $rab_work_list_dto = null)
 * @method bool deleteCountry()
 * @method bool prepareDeleteCountry(? array $attributes = null)
 * @method mixed getCountry()
 * @method ?Model prepareShowCountry(?Model $model = null, ?array $attributes = null)
 * @method array showCountry(?Model $model = null)
 * @method array viewCountryList()
 * @method Collection prepareViewCountryList(? array $attributes = null)
 * @method LengthAwarePaginator prepareViewCountryPaginate(PaginateData $paginate_dto)
 * @method array viewCountryPaginate(?PaginateData $paginate_dto = null)
 * @method Builder function country(mixed $conditionals = null)
 */
interface Country extends DataManagement{
}