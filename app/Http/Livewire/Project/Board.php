<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;

class Board extends Component
{

    public $project;

    protected $listeners = [
        'listAdded' => '$refresh'
    ];

    public function updateListOrder($list)
    {
        dd($list);
    }

    public function updateTaskOrder($tasks)
    {
        dd($tasks);
    }

    public function render()
    {
        return view('livewire.project.board');
    }
}
