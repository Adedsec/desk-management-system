<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'color', 'order'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function tasksCount()
    {
        return $this->tasks()->count();
    }
}
