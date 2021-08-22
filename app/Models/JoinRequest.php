<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{

    protected $fillable = ['sender_id', 'desk_id', 'user_id'];
    use HasFactory;

    public function desk()
    {
        return $this->belongsTo(Desk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function persianCreated()
    {
        $v = Verta($this->created_at);
        return $v->formatJalaliDate();

    }
}
