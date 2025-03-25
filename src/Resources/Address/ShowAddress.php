<?php

namespace Hanafalah\ModuleRegional\Resources\Address;

use Illuminate\Http\Request;

class ShowAddress extends ViewAddress
{
    public function toArray(Request $request): array{
        $arr = [
            'province'    => $this->relationValidation('province',function(){
                return $this->province->toViewApi();
            }),
            'district'    => $this->relationValidation('district',function(){
                return $this->district->toViewApi();
            }),
            'subdistrict' => $this->relationValidation('subdistrict',function(){
                return $this->subdistrict->toViewApi();
            }),
            'village'     => $this->relationValidation('village',function(){
                return $this->village->toViewApi();
            }),
        ];
        return $this->mergeArray(parent::toArray($request),$arr);
    }
}
