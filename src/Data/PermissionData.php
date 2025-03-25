<?php

namespace Hanafalah\LaravelPermission\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class PermissionData extends Data
{
    public function __construct(
        #[MapInputName('id')]
        #[MapName('id')]
        public mixed $id = null,

        #[MapInputName('parent_id')]
        #[MapName('parent_id')]
        public mixed $parent_id = null,

        #[MapInputName('name')]
        #[MapName('name')]
        public string $name,

        #[MapInputName('alias')]
        #[MapName('alias')]
        public ?string $alias = null,
        
        #[MapInputName('type')]
        #[MapName('type')]
        public ?string $type = 'Permission',

        #[MapInputName('guard_name')]
        #[MapName('guard_name')]
        public ?string $guard_name = 'api',

        #[MapInputName('visibility')]
        #[MapName('visibility')]
        public ?bool $visibility = true,

        #[MapInputName('root')]
        #[MapName('root')]
        public ?string $root = null,

        #[MapInputName('props')]
        #[MapName('props')]
        public ?array $props = null,

        #[MapInputName('childs')]
        #[MapName('childs')]
        /** @var PermissionData[] */
        public ?array $childs = []
    ) {}
}
