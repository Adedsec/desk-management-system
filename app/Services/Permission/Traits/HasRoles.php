<?php


namespace App\Services\Permission\Traits;


use App\Models\Desk;
use App\Models\Role;
use Illuminate\Support\Arr;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function giveRolesTo(...$roles)
    {
        $roles = $this->getAllRoles($roles);
        if ($roles->isEmpty()) return $this;
        //$roles = $this->generateRolesArray($roles);
        $this->roles()->syncWithoutDetaching($roles);
        return $this;
    }

    public function withdrawRoles(...$roles)
    {
        $roles = $this->getAllRoles($roles);
        //$roles = $this->generateRolesArray($roles);
        $this->roles()->detach($roles);
        return $this;
    }

    public function refreshRoles(...$roles)
    {
        $roles = $this->getAllRoles($roles);
        //$roles = $this->generateRolesArray($roles);
        $this->roles()->sync($roles);
        return $this;
    }

    public function hasRole(string $role)
    {
        return $this->roles->where('desk_id', $this->activeDesk->id ?? null)->contains('name', $role);
        //&& $this->roles()->withPivot('desk_id')->where('name', $role)->wherePivot('desk_id', $this->activeDesk->id)->first()->pivot->desk_id == $this->activeDesk->id;
    }

    protected function getAllRoles(...$roles)
    {
        return Role::whereIn('name', Arr::flatten($roles))->where('desk_id', $this->activeDesk->id)->get();
    }

    protected function generateRolesArray($roles)
    {
        $result = [];
        $desk = $this->activeDesk;
        foreach ($roles as $role) {
            $result[$role->id] = ['desk_id' => $desk->id];
        }
        return $result;

    }
}
