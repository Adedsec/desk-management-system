<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;

class Board extends Component
{

    public $project;

    protected $listeners = [
        'listAdded' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.project.board');
    }
}
