<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class LetterListInput extends Component
{

    public $letters;

    protected $listeners = [
        'refreshLetterList'
    ];


    public function render()
    {
        return view('livewire.components.letter-list-input');
    }
}
