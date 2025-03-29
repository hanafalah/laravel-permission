<?php

namespace Hanafalah\ModuleRegional\Contracts\Schemas\Regional;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface Village extends DataManagement{
    public function village(mixed $conditionals = null): Builder;
    public function prepareViewVillagePaginate(PaginateData $paginate_dto): LengthAwarePaginator;
    public function viewVillagePaginate(?PaginateData $paginate_dto = null);
}