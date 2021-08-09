<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;

class TasksPage extends Component
{

    public $project;

    public function render()
    {
        return view('livewire.project.tasks-page');
    }
}
