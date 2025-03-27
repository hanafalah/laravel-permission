<?php

namespace Hanafalah\ModuleRegional\Schemas\Regional;

use Hanafalah\LaravelSupport\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleRegional\Contracts\Schemas\Regional\Address as RegionalAddress;
use Hanafalah\ModuleRegional\Data\AddressData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class Address extends PackageManagement implements RegionalAddress{
    protected string $__entity = 'Address';
    public static $address_model;

    protected function showUsingRelation(): array{
        return [
            'province','district','subdistrict','village'
        ];
    }

    protected function viewUsingRelation(): array{
        return [];
    }    

    public function prepareStoreAddress(AddressData $address_dto): Model{
        $guard = isset($address_dto->id) 
                    ? ['id' => $address_dto->id] 
                    : [
                        'model_type' => $address_dto->model_type,
                        'model_id'   => $address_dto->model_id,
                        'flag'       => $address_dto->flag
                    ];
        $address = $this->address()->updateOrCreate($guard,[
            'name'           => $address_dto->name,
            'province_id'    => $address_dto->province_id,
            'district_id'    => $address_dto->district_id,
            'subdistrict_id' => $address_dto->subdistrict_id,
            'village_id'     => $address_dto->village_id
        ]);

        if (isset($address_dto->props)){
            foreach ($address_dto->props as $key => $value) $address->{$key} = $value ?? null;
        }
        $address->save();

        $this->setRegional($address, $address_dto->province_id, 'province')
             ->setRegional($address, $address_dto->district_id, 'district')
             ->setRegional($address, $address_dto->subdistrict_id, 'subdistrict')
             ->setRegional($address, $address_dto->village_id, 'village');
        
        return static::$address_model = $address;
    }

    private function setRegional(Model &$address, ?int $id = null, string $type): self{
        if (isset($id)){
            $model = Str::ucfirst($type);
            $model = $this->{$model.'Model'}()->findOrFail($id);
            $address->sync($model,['id','name']);
        }else{
            $address->{'prop_'.$type} = [
                'id'   => null,
                'name' => null
            ];
            $address->save();
        }
        return $this;
    }

    public function storeAddress(?AddressData $address_dto = null): array{
        return $this->transaction(function() use ($address_dto){
            return $this->showAddress($this->prepareStoreAddress($address_dto ?? $this->requestDTO(AddressData::class)));
        });
    }

    public function prepareViewAddressPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return static::$address_model = $this->address()->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewAddressPaginate(?PaginateData $paginate_dto = null){
        return $this->viewEntityResource(function() use ($paginate_dto){
            return $this->prepareViewAddressPaginate($paginate_dto ?? PaginateData::from(request()->all()));
        });
    }

    public function prepareViewAddressList(? array $attributes = null): Collection{
        $attributes ??= request()->all();
        return static::$address_model = $this->address()->get();
    }

    public function viewAddressList(){
        return $this->viewEntityResource(function(){
           return $this->prepareViewAddressList(); 
        });
    }

    public function address(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->AddressModel()->with($this->viewUsingRelation())
                ->when(isset(request()->search_model_id,request()->search_model_type),function($query){
                    $query->where('search_model_id',request()->search_model_id)
                        ->where('search_model_type',request()->search_model_type);
                })->withParameters()->conditionals($conditionals);
    }
}
