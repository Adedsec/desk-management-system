<?php

namespace App\Http\Livewire\Note;

use Livewire\Component;

class Index extends Component
{

    public $desk;

    protected $listeners = [
        'refreshNotes' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.note.index');
    }
}
