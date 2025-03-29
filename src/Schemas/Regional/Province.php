<?php

namespace Hanafalah\ModuleRegional\Schemas\Regional;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleRegional\Contracts\Schemas\Regional\Province as RegionalProvince;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class Province extends PackageManagement implements RegionalProvince
{
    protected array $__guard   = ['id', 'code', 'name'];
    protected array $__add     = ['code', 'name', 'latitude', 'longitude'];
    protected string $__entity = 'Province';
    public static $province_model;

    public function province(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->ProvinceModel()->conditionals($this->mergeCondition($conditionals ?? []));
    }

    public function prepareViewProvincePaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return static::$province_model = $this->province()->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewProvincePaginate(?PaginateData $paginate_dto = null){
        return $this->transforming($this->usingEntity()->getViewResource(),function() use ($paginate_dto){
            return $this->prepareViewProvincePaginate($paginate_dto ?? PaginateData::from(request()->all()));
        });
    }
}
