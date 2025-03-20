<?php

namespace Hanafalah\ModuleRegional\Schemas;

use Hanafalah\LaravelSupport\Contracts\DataManagement;
use Hanafalah\LaravelSupport\Supports\PackageManagement;

class District extends PackageManagement implements DataManagement
{
    protected array $__guard   = ['id', 'province_id', 'code', 'name'];
    protected array $__add     = ['province_id', 'code', 'name'];
    protected string $__entity = 'District';

    /**
     * Add a new API access or update the existing one if found.
     *
     * The given attributes will be merged with the existing API access.
     *
     * @param array $attributes The attributes to be added to the API access.
     *
     * @return \Illuminate\Database\Eloquent\Model The API access model.
     */
    public function addOrChange(?array $attributes = []): self
    {
        $this->updateOrCreate($attributes);
        return $this;
    }
}
