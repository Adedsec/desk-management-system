<?php

namespace App\Http\Livewire\Project;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{

    public $filter;
    public $projects;

    public function mount()
    {
        $this->projects = Auth::user()->activeDesk->projects()->whereHas('users', function ($q) {
                $q->where('user_id', Auth::user()->id);
            })->get() ?? null;

    }


    public function updated($name)
    {
        if ($name = 'filter') {

            $this->projects = Auth::user()->activeDesk->projects()->where('name', 'like', "%" . $this->filter . "%")->get();
        }
    }

    public function render()
    {
        return view('livewire.project.index')->extends('layouts.app')
            ->section('content');;
    }
}
