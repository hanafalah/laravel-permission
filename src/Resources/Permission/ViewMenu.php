<?php

namespace Hanafalah\LaravelPermission\Resources\Permission;

use Hanafalah\LaravelSupport\Resources\ApiResource;
use Hanafalah\LaravelPermission\Enums\Permission\Type;

class ViewMenu extends ApiResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request): array
  {
    $arr = [
      'name'        => $this->name,
      'alias'       => $this->alias,
      'directory'   => $this->directory,
      'method'      => $this->method,
      'slug'        => $this->slug,
      'access'      => true,
      'icon'        => $this->icon,
      'childs'      => $this->relationValidation('recursiveMenus',function(){
        return $this->recursiveMenus->transform(function($menu){
          return new static($menu);
        });
      })
    ];

    return $arr;
  }
}
