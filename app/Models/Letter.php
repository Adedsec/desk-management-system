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


    public function paraphs()
    {
        return $this->hasMany(Paraph::class);
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


    public function archiveUsers()
    {
        return $this->belongsToMany(User::class, 'letter_archive', 'letter_id', 'user_id');
    }

    public function isArchived(User $user)
    {
        return $user->archivedLetters->contains($this);
    }

    public function toggleArchive(User $user)
    {
        if ($this->isArchived($user)) {
            $user->archivedLetters()->detach($this);
        } else {
            $user->archivedLetters()->attach($this);
        }
    }

    public function getUserParaphs(User $user)
    {

        return $this->paraphs()->where(function ($query) use ($user) {
            $query->whereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->orWhere('user_id', $user->id);
        })->get();
    }

    public function userHasParaph(User $user)
    {
        return $this->getUserParaphs($user)->count() == 0 ? false : true;
    }


}
