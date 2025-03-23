<?php

namespace Hanafalah\ModuleRegional\Schemas;

use Hanafalah\LaravelSupport\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleRegional\Contracts\Regional\District as RegionalDistrict;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class District extends PackageManagement implements RegionalDistrict
{
    protected array $__guard   = ['id', 'province_id', 'code', 'name'];
    protected array $__add     = ['province_id', 'code', 'name'];
    protected string $__entity = 'District';
    public static $district_model;

    public function district(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->DistrictModel()->conditionals($this->mergeCondition($conditionals ?? []));
    }

    public function prepareViewDistrictPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return static::$district_model = $this->district()->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewDistrictPaginate(?PaginateData $paginate_dto = null){
        return $this->transforming($this->usingEntity()->getViewResource(),function() use ($paginate_dto){
            return $this->prepareViewDistrictPaginate($paginate_dto ?? PaginateData::from(request()->all()));
        });
    }
}
