<?php

namespace Hanafalah\LaravelPermission\Resources\Permission;

use Hanafalah\LaravelSupport\Resources\ApiResource;
use Illuminate\Support\Str;
use Hanafalah\LaravelPermission\Enums\Permission\Type;

class ViewPermission extends ApiResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request): array
  {
    $alias = $this->clearence($this->alias);
    $arr = [
      'id'          => $this->id,
      'name'        => $this->name,
      'parent_id'   => $this->parent_id,
      'alias'       => $alias,
      'original_alias' => $this->alias,
      'type' => $this->type,
      'access'      => ($this->access ?? 0) == 1 ? true : false,
      'directory'   => $this->directory,
      'method'      => $this->method,
      'slug'        => $this->slug,
      'accessibility' => $this->relationValidation('childs', function () {
        return (object) $this->childs->where('type', Type::PERMISSION->value)->mapWithKeys(function ($permission) {
          $alias = $this->clearence($permission->alias);
          return [
            $alias => (bool) $permission->access ?? false
          ];
        });
      }),
      'modules' => $this->relationValidation('recursiveModules', function () {
        return (object) $this->recursiveModules->where('type', Type::MODULE->value)->mapWithKeys(function ($permission) {
          $alias = $this->clearence($permission->alias,false);
          if (Str::startsWith($alias, 'show.')) $alias = Str::after($alias,'show.');
          return [
            $alias => (bool) $permission->access ?? false
          ];
        });
      }),
    ];

    if ($this->relationLoaded('recursiveChilds') && count($this->recursiveChilds) > 0) {
      $arr['permissions'] = $this->relationValidation('recursiveChilds', function () {
        return $this->recursiveChilds->transform(function ($child) {
          return new static($child);
        });
      });
    }

    return $arr;
  }

  private function clearence($permission_alias){
    $alias = $this->alias;
    $alias = Str::beforeLast($alias, '.', $permission_alias);
    $alias = Str::replace($alias . '.', '', $permission_alias);
    return $alias;
  }
}
