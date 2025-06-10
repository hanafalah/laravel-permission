<?php

namespace Hanafalah\LaravelPermission\Data;

use Hanafalah\LaravelPermission\Contracts\Data\RoleData as DataRoleData;
use Hanafalah\LaravelSupport\Supports\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class RoleData extends Data implements DataRoleData
{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public string $name;

    #[MapInputName('permission_ids')]
    #[MapName('permission_ids')]
    public mixed $permission_ids = null;

    #[MapInputName('permissions')]
    #[MapName('permissions')]
    public ?array $permissions = [];

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = [];

    public static function after(RoleData $data): RoleData{
        if (isset($data->permissions)){
            $data->permissions = array_map(fn($permission) => $permission['id'] ?? null, $data->permissions);
        }
        $data->permissions = $data->permission_ids ?? $data->permissions ?? [];
        $data->permissions = static::new()->mustArray($data->permissions);
        return $data;
    }
}
