<?php

namespace App\Models;

use App\Services\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, HasPermissions;

    protected $fillable = ['name', 'persian_name'];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function desk()
    {
        return $this->belongsTo(Desk::class);
    }

    public function desks()
    {
        return $this->belongsToMany(Desk::class, 'role_user', 'role_id', 'desk_id');
    }
}
