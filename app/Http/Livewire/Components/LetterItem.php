<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class LetterItem extends Component
{
    public $letter;

    public function render()
    {
        return view('livewire.components.letter-item');
    }
}
