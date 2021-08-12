<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Note extends Component
{
    public $note;

    public function delete()
    {
        $this->note->delete();
        session()->flash('success', 'یادداشت با موفقیت حذف شد');
        $this->emit('refreshNotes');
    }

    public function render()
    {
        return view('livewire.components.note');
    }
}
