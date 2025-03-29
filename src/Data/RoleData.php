<?php

namespace Hanafalah\LaravelPermission\Data;

use Hanafalah\LaravelPermission\Contracts\Data\RoleData as DataRoleData;
use Hanafalah\LaravelSupport\Supports\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class RoleData extends Data implements DataRoleData
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
