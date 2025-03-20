<?php

namespace Zahzah\LaravelPermission\Enums\Permission;

enum Type : string{
    case MENU       = 'MENU';
    case MODULE     = 'MODULE';
    case PERMISSION = 'PERMISSION';
}