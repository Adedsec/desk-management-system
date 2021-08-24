<?php


namespace App\Services\Permission\Traits;


use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

trait HasPermissions
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions->isEmpty()) return $this;
        //if ($this instanceof User)
        //$permissions = $this->generatePermissionsArray($permissions);
        $this->permissions()->syncWithoutDetaching($permissions);
        return $this;
    }

    public function withdrawPermissions(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        //if ($this instanceof User)
        //$permissions = $this->generatePermissionsArray($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissions(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        //if ($this instanceof User)
        //$permissions = $this->generatePermissionsArray($permissions);
        $this->permissions()->sync($permissions);
        return $this;

    }

    public function hasPermission(Permission $permission)
    {
        return $this->hasPermissionsThroughRole($permission) || ($this->permissions->contains($permission)
                //&&
                //$this->permissions()->withPivot('desk_id')->where('name', $permission->name)->first()->pivot->desk_id == $this->activeDesk->id
            );
    }

    protected function hasPermissionsThroughRole(Permission $permission)
    {
        //dd($permission->roles);
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role))
                //&&
                //$this->roles()->withPivot('desk_id')->where('name', $role->name)->first()->pivot->desk_id == Auth::user()->activeDesk->id)
                return true;
        }
        return false;
    }

    protected function getAllPermissions(array $permissions)
    {

        return Permission::whereIn('name', Arr::flatten($permissions))->get();
    }

    protected function generatePermissionsArray($permissions)
    {

        $result = [];
        $desk = $this->activeDesk;
        foreach ($permissions as $permission) {

            $result[$permission->id] = ['desk_id' => $desk->id];
        }
        return $result;

    }
}
