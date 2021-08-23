<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desk extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function joinRequests()
    {
        return $this->hasMany(JoinRequest::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'desk_id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user', 'desk_id', 'permission_id');
    }

    public function userTasksCount(User $user)
    {
        return $this->tasks()->whereHas('users', function ($q) use ($user) {
            $q->where('id', $user->id);
        })->count();
    }

    public function delayTasksCount()
    {
        return $this->tasks()->where('deadline', '<', Carbon::now())->count();
    }


}
