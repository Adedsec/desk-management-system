<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class LetterListInput extends Component
{

    public $letters;

    protected $listeners = [
        'refreshLetterList' => '$refresh'
    ];


    public function render()
    {
        return view('livewire.components.letter-list-input');
    }
}
