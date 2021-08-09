<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'deadline', 'user_id', 'desk_id', 'task_list_id', 'project_id', 'order', 'progress'];

    public function desk()
    {
        return $this->belongsTo(Desk::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function list()
    {
        return $this->belongsTo(TaskList::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkList()
    {
        return $this->hasOne(CheckList::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }


}
