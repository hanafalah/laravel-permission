<?php

namespace Hanafalah\ModuleRegional\Resources\Address;

use Illuminate\Http\Request;

class ShowAddress extends ViewAddress
{
    public function toArray(Request $request): array{
        $arr = [
            'province'    => $this->relationValidation('province',function(){
                return $this->province->toViewApi()->resolve();
            }),
            'district'    => $this->relationValidation('district',function(){
                return $this->district->toViewApi()->resolve();
            }),
            'subdistrict' => $this->relationValidation('subdistrict',function(){
                return $this->subdistrict->toViewApi()->resolve();
            }),
            'village'     => $this->relationValidation('village',function(){
                return $this->village->toViewApi()->resolve();
            }),
        ];
        return $this->mergeArray(parent::toArray($request),$arr);
    }
}
