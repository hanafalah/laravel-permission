<?php

namespace Zahzah\LaravelPermission\Resources\Permission;

use Zahzah\LaravelSupport\Resources\ApiResource;
use Zahzah\LaravelPermission\Enums\Permission\Type;

class ViewMenu extends ApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array{
      $arr = [
        'name'        => $this->name,
        'alias'       => $this->alias,
        'directory'   => $this->directory,
        'method'      => $this->method,
        'slug'        => $this->slug,
        'access'      => true,
        'icon'        => $this->icon
      ];
      if ($this->type == Type::MENU->value){
        $this->load(['childs' => function($q){
            $q->where('type',Type::MENU->value)
              ->whereHas('roleHasPermission',function($q){
                $q->where('role_id',$this->role_id);
              })
              ->orderBy('name','asc');
        }]);
        if (count($this->childs) > 0){
          foreach ($this->childs as $child){
            $arr['childs'][] = new ViewMenu($child);
          }
        }
      }
      
      return $arr;
    }
}
