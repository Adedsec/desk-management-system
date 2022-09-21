<?php

namespace App\Models;

use App\Jobs\SendEmail;
use App\Mail\ResetPassword;
use App\Mail\VerificationEmail;
use App\Services\Permission\Traits\HasPermissions;
use App\Services\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravolt\Avatar\Facade as Avatar;
use function PHPUnit\Framework\isEmpty;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasPermissions, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'provider',
        'provider_id',
        'avatar',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function desk()
    {
        return $this->hasOne(Desk::class, 'admin_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    public function archivedLetters()
    {
        return $this->belongsToMany(Letter::class, 'letter_archive', 'user_id', 'letter_id');
    }


    public function desks()
    {
        return $this->belongsToMany(Desk::class, 'desk_user', 'user_id', 'desk_id');
    }

    public function hasDesk()
    {
        return !$this->desks->isEmpty();
    }

    public function joinRequests()
    {
        return $this->hasMany(JoinRequest::class);
    }

    public function activeDesk()
    {
        return $this->belongsTo(Desk::class, 'active_desk_id');
    }

    public function sendEmailVerificationNotification()
    {
        SendEmail::dispatch($this, new VerificationEmail($this));
    }

    public function sendPasswordResetNotification($token)
    {

        SendEmail::dispatch($this, new ResetPassword($this, $token));
    }


    public function getAvatar()
    {
        return is_null($this->avatar)
            ? Avatar::create($this->email)->toBase64()->setFont(asset('fonts/Vazir-Bold.ttf'))
            : $this->avatar;
    }
}
