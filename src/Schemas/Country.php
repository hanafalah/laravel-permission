<?php

namespace Zahzah\ModuleRegional\Schemas;

use Zahzah\LaravelSupport\Contracts\DataManagement;
use Zahzah\LaravelSupport\Supports\PackageManagement;
use Illuminate\Database\Eloquent\Builder;

class Country extends PackageManagement implements DataManagement{
    protected array $__guard   = ['id', 'country_code', 'name'];
    protected array $__add     = ['name'];
    protected string $__entity = 'Country';

    public function country(mixed $conditionals = null): Builder{
        return $this->getModel()->conditionals($conditionals);
    }

    public function getCountries(){
        return $this->country(function($q){
            if (request()->has('search_name')) {
                $q->where('name', 'like', '%' . request('search_name') . '%');
            }
        })->paginate(request('per_page'))->appends(request()->all());
    }

    /**
     * Add a new API access or update the existing one if found.
     *
     * The given attributes will be merged with the existing API access.
     *
     * @param array $attributes The attributes to be added to the API access.
     *
     * @return \Illuminate\Database\Eloquent\Model The API access model.
     */
    public function addOrChange(? array $attributes=[]): self{
        $this->updateOrCreate($attributes);
        return $this;
    }
}
