<?php

namespace Zahzah\LaravelPermission\Resources\Permission;

use Zahzah\LaravelSupport\Resources\ApiResource;
use Illuminate\Support\Str;
use Zahzah\LaravelPermission\Enums\Permission\Type;

class ViewPermission extends ApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array{
      $alias = $this->clearence($this->alias);
      $arr = [
        'id'          => $this->id,
        'name'        => $this->name,
        'parent_id'   => $this->parent_id,
        'alias'       => $alias,
        'access'      => ($this->access ?? 0) == 1 ? true : false,
        'directory'   => $this->directory,
        'method'      => $this->method,
        'slug'        => $this->slug,
        'permissions' => $this->relationValidation('childs',function(){
          $childs = $this->childs;
          return (object) $childs->where('type',Type::PERMISSION->value)->mapWithKeys(function($permission){
            $alias = $this->clearence($permission->alias);
            return [
              $alias => $permission->access ?? false
            ];
          });
        }),
        'modules' => $this->relationValidation('childs',function(){
          $childs = $this->childs;
          return (object) $childs->where('type',Type::MODULE->value)->mapWithKeys(function($permission){
            $alias = $this->clearence($permission->alias);
            $alias = explode('.',$alias);
            return [
              $alias[0] => [
                $alias[1] => $permission->access ?? false
              ]
            ];
          });
        }),
      ];

      if ($this->relationLoaded('recursiveChilds') && count($this->recursiveChilds) > 0) {
        $arr['permissions'] = $this->relationValidation('recursiveChilds',function(){
          return $this->recursiveChilds->transform(function($child){
            return new static($child);
          });
        });
      }
      
      return $arr;
    }

    private function clearence($permission_alias){
      $alias = Str::beforeLast($this->alias, '.', $permission_alias);
      $alias = Str::replace($alias.'.','',$permission_alias);
      return $alias;
    }
}
