<?php

namespace Hanafalah\ModuleRegional\Resources\Country;

use Illuminate\Http\Request;
use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewCountry extends ApiResource
{

    /**
     * Transform the resource into an array.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $arr = [
            'id'            => $this->id,
            'country_code'  => $this->country_code,
            'name'          => $this->name
        ];

        return $arr;
    }
}
