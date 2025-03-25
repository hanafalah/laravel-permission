<?php

namespace Hanafalah\ModuleRegional\Schemas\Citizenship;

use Hanafalah\LaravelSupport\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleRegional\Contracts\Citizenship\Country as CitizenshipCountry;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class Country extends PackageManagement implements CitizenshipCountry
{
    protected array $__guard   = ['id', 'country_code', 'name'];
    protected array $__add     = ['name'];
    protected string $__entity = 'Country';
    public static $country_model;

    public function country(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->CountryModel()->conditionals($conditionals);
    }

    public function prepareViewCountryPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return static::$country_model = $this->country()->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewCountryPaginate(?PaginateData $paginate_dto = null){
        return $this->transforming($this->usingEntity()->getViewResource(),function() use ($paginate_dto){
            return $this->prepareViewCountryPaginate($paginate_dto ?? PaginateData::from(request()->all()));
        });
    }
}
