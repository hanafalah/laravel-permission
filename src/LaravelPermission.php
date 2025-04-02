<?php

namespace Hanafalah\LaravelPermission;

use Hanafalah\LaravelPermission\Contracts\LaravelPermission as ContractsLaravelPermission;
use Hanafalah\LaravelPermission\Enums\Permission\Type;
use Hanafalah\LaravelPermission\Supports\BaseLaravelPermission;
use Illuminate\Support\Str;

class LaravelPermission extends BaseLaravelPermission implements ContractsLaravelPermission {
    public function scanRoles(string $path): array{
        return $this->fileScans($path,'role');
    }
    
    public function scanPermissions(string $path): array{
        return $this->fileScans($path,'permission');
    }

    private function fileScans(string $path,string $type): array{
        $lists = array_map(function ($data) use ($path,$type){
            $file_name = $data;
            $data      = include_once($path . '/' . $data);
            if ($type == 'permission'){
                $this->recursivePermissions($data);            
            }else{
                $this->recursiveRoles($file_name,$data);            
            }
            return $data;
        }, array_filter(scandir($path), function ($data) {
            return strpos($data, '.php') !== false;
        }));

        $lists = array_values($lists);
        return $lists;  
    }

    private function recursiveRoles(string $file_name, mixed $permissions){
        $role = Str::replace('.php','',$file_name);
        $role = Str::replace('_','',$role);
        $role = Str::title($role);
        $role = $this->RoleModel()->firstOrCreate(['name' => $role]);
        try {
            $role->syncPermissions($permissions);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function recursivePermissions(mixed &$permission,string $alias = ''){
        $is_show_acl = isset($permission['show_in_acl']);
        if ($permission['type'] !== Type::PERMISSION->value){
            $permission['alias'] .= ($is_show_acl) ? '.index' : '.';
            if ($alias != '') $permission['alias'] = $alias.$permission['alias'];
            if ($is_show_acl) {
                $permission['directory'] = Str::replace('.','/',$permission['alias']);
                $directory = &$permission['directory'];
                $directory = Str::replace('/index','',$directory);
                $directory = Str::replace('/show','',$directory);
            }
            if ($this->isPermissionHasChild($permission)){
                foreach ($permission['childs'] as &$child_permission) {
                    $this->recursivePermissions($child_permission, $permission['alias']);
                }
            }
        }else{
            $alias = Str::replace('.index','',$alias);
            $alias = Str::replace('.show','',$alias);
            $permission['alias'] = $alias.'.'.$permission['alias'];
        }
    }

    private function isPermissionHasChild(array $permission): bool{
        return isset($permission['childs']) && count($permission['childs']) > 0;
    }
}
