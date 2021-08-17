<?php

namespace App\Models;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
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
        return $this->belongsTo(CheckList::class);
    }



    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }


    public function persianDeadline()
    {
        $v = new Verta($this->deadline);
        return $v->format('%d %B، %Y   ساعت : H:i');
    }

    public function editDeadline()
    {
        return is_null($this->deadline) ? null : Carbon::parse($this->deadline)->format('Y-m-d\TH:i');
    }


}
