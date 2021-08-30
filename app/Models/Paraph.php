<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paraph extends Model
{
    use HasFactory;

    protected $fillable = [
        'body', 'user_id', 'letter_id'
    ];

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
