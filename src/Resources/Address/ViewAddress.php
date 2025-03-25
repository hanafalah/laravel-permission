<?php

namespace Hanafalah\ModuleRegional\Resources\Address;

use Illuminate\Http\Request;
use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewAddress extends ApiResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'zip_code'          => $this->zip_code,
            'province'          => [
                'id'   => $this->prop_province->id ?? null,
                'name' => $this->prop_province->name ?? null
            ],
            'district'          => [
                'id'   => $this->prop_district->id ?? null,
                'name' => $this->prop_district->name ?? null
            ],
            'subdistrict'       => [
                'id'   => $this->prop_subdistrict->id ?? null,
                'name' => $this->prop_subdistrict->name ?? null
            ],
            'village'           => [
                'id'   => $this->prop_village->id ?? null,
                'name' => $this->prop_village->name ?? null
            ]
        ];

        return $arr;
    }
}
