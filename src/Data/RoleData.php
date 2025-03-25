<?php

namespace Hanafalah\LaravelPermission\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\ArrayType;

class RoleData extends Data
{
    public function __construct(
        #[MapInputName('id')]
        #[MapName('id')]
        public mixed $id = null,

        #[MapInputName('name')]
        #[MapName('name')]
        public string $name,

        #[MapInputName('permission_id')]
        #[MapName('permission_id')]
        public mixed $permission_id = null,

        #[MapInputName('permissions')]
        #[MapName('permissions')]
        public ?array $permissions = []
    ) {
        $this->permissions = $this->permission_id ?? $this->permissions ?? [];
        $this->permissions = $this->mustArray($this->permissions);
    }
}
