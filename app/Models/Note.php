<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'image', 'color', 'user_id', 'check_list_id', 'desk_id'];

    public function desk()
    {
        return $this->belongsTo(Desk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkList()
    {
        return true;
    }
}
