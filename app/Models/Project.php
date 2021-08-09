<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'admin_id', 'desk_id', 'color', 'image'];


    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function desk()
    {
        return $this->belongsTo(Desk::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function lists()
    {
        return $this->hasMany(TaskList::class);
    }

    public function withoutListsTasks()
    {
        return $this->tasks()->where('task_list_id', null)->get();
    }

    public function withoutListTasksCount()
    {
        return $this->withoutListsTasks()->count();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function lastListOrder()
    {
        return is_null($this->lists()->orderByDesc('order')->first()) ? 1 : $this->lists()->orderByDesc('order')->first()->order;
    }
}
