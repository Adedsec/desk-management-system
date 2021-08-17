<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id', 'archived'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function desk()
    {
        return $this->belongsTo(Desk::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function summary()
    {
        $body = $this->body;
        return mb_substr($body, 0, 50, 'utf-8') . ' ...';
    }

    public function persianCreated()
    {
        $v = new Verta($this->created_at);
        return $v->format('%d %B، %Y   ساعت : H:i');
    }


    public function archive()
    {

    }

    public function toggleArchive()
    {
        if ($this->archived) {
            $this->archived = false;
            $this->save();
        } else {
            $this->archived = true;
            $this->save();
        }
    }


}
