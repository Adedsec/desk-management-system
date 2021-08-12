<?php

namespace App\Http\Livewire\Task;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{

    public $tasks;

    public function mount()
    {
        $this->tasks = Auth::user()->activeDesk->tasks;
    }

    public function render()
    {
        return view('livewire.task.index');
    }
}
