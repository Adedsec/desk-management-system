<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isEmpty;

class TaskList extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'color', 'order'];

    protected $attributes = ['color' => 'white'];

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

    public function deletable()
    {
        return $this->tasks->count() == 0;
    }
}
