<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Facade as Avatar;

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


    public function getAvatar()
    {
        return is_null($this->image)
            ? Avatar::create($this->name)->setFont(asset('fonts/Vazir-Bold.ttf'))
            : $this->image;
    }

    public function completedTasksCount()
    {
        return $this->tasks()->where('checked', true)->count();
    }

    public function allTasksCount()
    {
        return $this->tasks()->count();
    }

    public function userTasksCount()
    {
        return $this->tasks()->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->count();
    }

    public function userCompletedTasksCount()
    {
        return $this->tasks()->where('checked', true)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->count();
    }

    public function generalProgress()
    {
        return $this->allTasksCount() == 0 ? 0 : intval(($this->completedTasksCount() / $this->allTasksCount()) * 100);
    }

    public function userProgress()
    {
        return $this->userTasksCount() == 0 ? 0 : intval(($this->userCompletedTasksCount() / $this->userTasksCount()) * 100);
    }

    public function delayTasksCount()
    {
        return $this->tasks()->where('deadline', '<', Carbon::now())->count();
    }

    public function delayedProgress()
    {
        return $this->allTasksCount() == 0 ? 0 : intval($this->delayTasksCount() / $this->allTasksCount() * 100);
    }
}
