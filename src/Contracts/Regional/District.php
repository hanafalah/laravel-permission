<?php

namespace Hanafalah\ModuleRegional\Contracts\Regional;

use Hanafalah\LaravelSupport\Contracts\DataManagement;
use Hanafalah\LaravelSupport\Data\PaginateData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface District extends DataManagement{
    public function district(mixed $conditionals = null): Builder;
    public function prepareViewDistrictPaginate(PaginateData $paginate_dto): LengthAwarePaginator;
    public function viewDistrictPaginate(?PaginateData $paginate_dto = null);
}