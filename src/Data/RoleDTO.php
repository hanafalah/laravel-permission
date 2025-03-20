<?php

namespace Zahzah\LaravelPermission\Data;

use Zahzah\LaravelSupport\Supports\Data;

class RoleDTO extends Data{
    public function __construct(
        public mixed $id,
        public string $name,
        public mixed $permission_id,
        public ?array $permissions = null
    ){
        $this->permissions = $this->permission_id ?? $this->permissions ?? [];
        $this->permissions = $this->mustArray($this->permissions);
    }
}