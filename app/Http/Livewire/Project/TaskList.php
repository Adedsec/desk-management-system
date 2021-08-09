<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;

class TaskList extends Component
{

    public $project;
    public $list;

    public function render()
    {
        return view('livewire.project.task-list');
    }
}
