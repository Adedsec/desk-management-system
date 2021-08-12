<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];


    public function tasks()
    {
        return $this->morphedByMany(Task::class, 'taggable');
    }

    public function notes()
    {
        return $this->morphedByMany(Note::class, 'taggable');
    }

    public function letters()
    {
        return $this->morphedByMany(Letter::class, 'taggable');
    }

    public static function getNoteAvailableTags()
    {
        $desk = Auth::user()->activeDesk;
        return Tag::where('type', 'note')->where('desk_id', $desk->id)->get();
    }

    public static function getLetterAvailableTags()
    {
        $desk = Auth::user()->activeDesk;
        return Tag::where('type', 'letter')->where('desk_id', $desk->id)->get();
    }

    public static function getTaskAvailableTags()
    {
        $desk = Auth::user()->activeDesk;
        return Tag::where('type', 'task')->where('desk_id', $desk->id)->get();
    }


}
