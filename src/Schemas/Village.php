<?php

namespace Hanafalah\ModuleRegional\Schemas;

use Hanafalah\LaravelSupport\Contracts\DataManagement;
use Hanafalah\LaravelSupport\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class Village extends PackageManagement implements DataManagement
{
    protected array $__guard   = ['id', 'village_id', 'district_id', 'province_id', 'code', 'name'];
    protected array $__add     = ['village_id', 'district_id', 'province_id', 'code', 'name'];
    protected string $__entity = 'Village';
    public static $village_model;

    public function village(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->VillageModel()->conditionals($this->mergeCondition($conditionals ?? []));
    }

    public function prepareViewVillagePaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return static::$village_model = $this->village()->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewVillagePaginate(?PaginateData $paginate_dto = null){
        return $this->transforming($this->usingEntity()->getViewResource(),function() use ($paginate_dto){
            return $this->prepareViewVillagePaginate($paginate_dto ?? PaginateData::from(request()->all()));
        });
    }
}
