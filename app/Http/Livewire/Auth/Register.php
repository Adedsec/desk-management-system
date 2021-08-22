<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $phone_number;
    public $email;
    public $password;
    public $password_confirmation;

    public $title = 'ثبت نام در میزکار';

    protected $rules = [
        'name' => 'required|string|max:190',
        'phone_number' => 'required|numeric|digits:11|unique:users',
        'email' => 'required|string|max:255|email|unique:users',
        'password' => 'required|string|min:8|confirmed'
    ];


    public function updated($name)
    {
        $this->validateOnly($name);
    }

    public function render()
    {

        return view('livewire.auth.register')
            ->extends('layouts.app', ['title' => $this->title])
            ->section('content');
    }
}
