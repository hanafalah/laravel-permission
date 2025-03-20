<?php

namespace Zahzah\LaravelPermission\Enums\Permission;

enum Access: int{
    case DENY    = 0;
    case ALLOW   = 1;
}