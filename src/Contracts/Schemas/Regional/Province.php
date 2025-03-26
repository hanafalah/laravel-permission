<?php

namespace Hanafalah\ModuleRegional\Contracts\Schemas\Regional;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Data\PaginateData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface Province extends DataManagement{
    public function province(mixed $conditionals = null): Builder;
    public function prepareViewProvincePaginate(PaginateData $paginate_dto): LengthAwarePaginator;
    public function viewProvincePaginate(?PaginateData $paginate_dto = null);
}