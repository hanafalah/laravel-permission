<?php

namespace Hanafalah\LaravelPermission\Enums\Permission;

enum Type: string
{
    case MENU       = 'MENU';
    case NAVIGATION = 'NAVIGATION';
    case MODULE     = 'MODULE';
    case PERMISSION = 'PERMISSION';
}
