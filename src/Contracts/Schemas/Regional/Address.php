<?php

namespace Hanafalah\ModuleRegional\Contracts\Schemas\Regional;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\ModuleRegional\Data\AddressData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @see \Hanafalah\ModuleRegional\Schemas\Address
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method mixed export(string $type)
 * @method bool deleteAddress()
 * @method bool prepareDeleteAddress(? array $attributes = null)
 * @method mixed getAddress()
 * @method ?Model prepareShowAddress(?Model $model = null, ?array $attributes = null)
 * @method array showAddress(?Model $model = null)
 * @method Collection prepareViewAddressList()
 * @method array viewAddressList()
 * @method LengthAwarePaginator prepareViewAddressPaginate(PaginateData $paginate_dto)
 * @method array viewAddressPaginate(?PaginateData $paginate_dto = null)
 * @method array storeAddress(?AddressData $funding_dto = null)
 */
interface Address extends DataManagement{
    public function prepareStoreAddress(AddressData $address_dto): Model;
}