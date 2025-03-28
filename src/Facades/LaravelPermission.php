<?php

namespace Hanafalah\LaravelPermission\Facades;

use Illuminate\Support\Facades\Facade;
use Hanafalah\LaravelPermission\Contracts\LaravelPermission as ContractsLaravelPermission;

class LaravelPermission extends Facade
{

   protected static function getFacadeAccessor()
   {
      return ContractsLaravelPermission::class;
   }
}
