<?php

namespace Hanafalah\LaravelPermission\Contracts\Schemas;

use Illuminate\Database\Eloquent\Collection;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;

/**
 * @see \Hanafalah\LaravelPermission\Schemas\Menu
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method array viewMenuList()
 */
interface Menu extends DataManagement
{
    public function prepareViewMenuList(): Collection;
    public function menu(mixed $conditionals = []): Builder;
}
