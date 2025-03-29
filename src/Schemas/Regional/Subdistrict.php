<?php

namespace Hanafalah\ModuleRegional\Schemas\Regional;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleRegional\Contracts\Schemas\Regional\Subdistrict as RegionalSubdistrict;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class Subdistrict extends PackageManagement implements RegionalSubdistrict
{
    protected array $__guard   = ['id', 'district_id', 'province_id', 'code', 'name'];
    protected array $__add     = ['district_id', 'province_id', 'code', 'name'];
    protected string $__entity = 'District';
    public static $subdistrict_model;

    public function subdistrict(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->SubdistrictModel()->conditionals($this->mergeCondition($conditionals ?? []));
    }

    public function prepareViewSubdistrictPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return static::$subdistrict_model = $this->subdistrict()->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewSubdistrictPaginate(?PaginateData $paginate_dto = null){
        return $this->transforming($this->usingEntity()->getViewResource(),function() use ($paginate_dto){
            return $this->prepareViewSubdistrictPaginate($paginate_dto ?? PaginateData::from(request()->all()));
        });
    }
}
