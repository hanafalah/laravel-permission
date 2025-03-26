<?php

namespace Hanafalah\ModuleRegional\Contracts\Schemas\Regional;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Data\PaginateData;
use Hanafalah\ModuleRegional\Data\AddressData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface Address extends DataManagement{
    public function prepareStoreAddress(AddressData $address_dto): Model;
    public function storeAddress(?AddressData $address_dto = null): array;
    public function prepareViewAddressPaginate(PaginateData $paginate_dto): LengthAwarePaginator;
    public function viewAddressPaginate(?PaginateData $paginate_dto = null);
    public function prepareViewAddressList(? array $attributes = null): Collection;
    public function viewAddressList();
    public function address(mixed $conditionals = null): Builder;
    
}