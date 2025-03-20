<?php

namespace Zahzah\ModuleRegional\Schemas;

use Zahzah\LaravelSupport\Contracts\DataManagement;
use Zahzah\LaravelSupport\Supports\PackageManagement;

class District extends PackageManagement implements DataManagement{
    public function booting(): self{
        static::$__class = $this;
        static::$__model = $this->{$this->__entity."Model"}();
        return $this;
}

protected array $__guard   = ['id', 'district_id', 'province_id', 'code', 'name']; 
    protected array $__add     = ['district_id', 'province_id', 'code', 'name'];
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
    public function addOrChange(? array $attributes=[]): self{    
        $this->updateOrCreate($attributes);
        return $this;
    }
}