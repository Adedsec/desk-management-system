<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class TaskItem extends Component
{

    public $task;

    public function render()
    {
        return view('livewire.components.task-item');
    }
}
