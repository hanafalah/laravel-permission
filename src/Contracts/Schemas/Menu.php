<?php

namespace Hanafalah\LaravelPermission\Contracts\Schemas;

use Illuminate\Database\Eloquent\Collection;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;

interface Menu extends DataManagement
{
    public function prepareViewMenuList(?array $attributes = null): Collection;
    public function viewMenuList(): array;
}
