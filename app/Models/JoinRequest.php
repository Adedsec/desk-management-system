<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{

    protected $fillable = ['sender_id', 'desk_id', 'user_id'];
    use HasFactory;
}
