<?php

namespace Hanafalah\ModuleRegional\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleRegional\Contracts\Data\AddressData as DataAddressData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Hanafalah\ModuleRegional\Enums\Address\Flag;

class AddressData extends Data implements DataAddressData{
    public function __construct(
        #[MapName('id')]
        #[MapInputName('id')]
        public mixed $id = null, 

        #[MapName('name')]
        #[MapInputName('name')]
        public string $name, 

        #[MapName('model_type')]
        #[MapInputName('model_type')]
        public ?string $model_type = null, 

        #[MapName('model_id')]
        #[MapInputName('model_id')]
        public mixed $model_id = null, 

        #[MapName('flag')]
        #[MapInputName('flag')]
        public ?string $flag = null, 

        #[MapName('province_id')]
        #[MapInputName('province_id')]
        public ?int $province_id = null, 

        #[MapName('district_id')]
        #[MapInputName('district_id')]
        public ?int $district_id = null, 

        #[MapName('subdistrict_id')]
        #[MapInputName('subdistrict_id')]
        public ?int $subdistrict_id = null, 

        #[MapName('village_id')]
        #[MapInputName('village_id')]
        public ?int $village_id = null,

        #[MapName('props')]
        #[MapInputName('props')]
        public ?AddressPropsData $props = null
    ){
        if (!isset($this->flag)) $this->flag = Flag::OTHER->value;
    }
}