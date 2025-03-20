<?php

namespace Zahzah\LaravelPermission\Resources\Role;

class ShowRole extends ViewRole
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(\Illuminate\Http\Request $request): array {
      $arr = [
        'permissions' => $this->relationValidation('permissions',function(){
          return $this->permissions->transform(function($permission){
            return $permission->toViewApi();
          });
        })
      ];
      
      $arr = $this->mergeArray(parent::toArray($request),$arr);
      return $arr;
    }
}
