<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JoinRequestMail extends Mailable
{
    use Queueable, SerializesModels;


    public $password;
    public $admin;
    public $desk;

    /**
     * Create a new message instance.
     *
     * @param  $desk
     * @param string $password
     * @param $admin
     */
    public function __construct($desk, string $password, $admin)
    {
        //
        $this->password = $password;
        $this->admin = $admin;
        $this->desk = $desk;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.join-request');
    }
}
