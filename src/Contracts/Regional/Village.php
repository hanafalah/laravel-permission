<?php

namespace Hanafalah\ModuleRegional\Contracts\Regional;

use Hanafalah\LaravelSupport\Contracts\DataManagement;
use Hanafalah\LaravelSupport\Data\PaginateData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface Village extends DataManagement{
    public function village(mixed $conditionals = null): Builder;
    public function prepareViewVillagePaginate(PaginateData $paginate_dto): LengthAwarePaginator;
    public function viewVillagePaginate(?PaginateData $paginate_dto = null);
}