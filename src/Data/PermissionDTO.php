<?php

namespace Zahzah\LaravelPermission\Data;

use Zahzah\LaravelSupport\Supports\Data;

class PermissionDTO extends Data{
    public function __construct(
        public mixed $id,
        public string $name,
        public ?string $alias = null,
        public mixed $parent_id,
        public ?string $type = 'Permission',
        public ?string $guard_name = 'api',
        public ?bool $visitibility = true,
        public ?string $root = null,
    ){}
}