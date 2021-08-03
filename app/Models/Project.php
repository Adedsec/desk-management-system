<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'admin_id', 'desk_id', 'color', 'image'];


    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function desk()
    {
        return $this->belongsTo(Desk::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function lists()
    {
        return true;
    }

    public function tasks()
    {
        return true;
    }
}
