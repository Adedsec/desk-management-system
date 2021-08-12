<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;

class TaskPage extends Component
{

    public $project;

    public function render()
    {
        return view('livewire.project.task-page');
    }
}
