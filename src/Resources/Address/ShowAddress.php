<?php

namespace Zahzah\ModuleRegional\Resources\Address;

use Illuminate\Http\Request;
use Zahzah\LaravelSupport\Resources\ApiResource;

class ShowAddress extends ApiResource{

    /**
     * Transform the resource into an array.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $arr = [
            'id'                => $this->id,
            'name'              => $this->name,
            'zip_code'          => $this->zip_code,
            'province_name'     => $this->prop_province->name ?? null,
            'district_name'     => $this->prop_district->name ?? null,
            'subdistrict_name'  => $this->prop_subdistrict->name ?? null,
            'village_name'      => $this->prop_village->name ?? null
        ];
        
        return $arr;
    }
}