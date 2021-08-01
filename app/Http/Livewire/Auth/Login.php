<?php

namespace App\Http\Livewire\Auth;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $title = 'ورود به میزکار';
    public $email;
    public $password;
    public $remember;

    protected $rules = [
        'email' => 'required|string|email|exists:users',
        'password' => 'required|string'
    ];

    public function updated($name)
    {
        $this->validateOnly($name);
    }


    public function render()
    {
        return view('livewire.auth.login')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }
}
