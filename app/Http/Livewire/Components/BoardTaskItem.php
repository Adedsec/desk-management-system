<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class BoardTaskItem extends Component
{

    public $task;

    public function render()
    {
        return view('livewire.components.board-task-item');
    }
}
