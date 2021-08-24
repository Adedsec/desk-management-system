<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Note extends Component
{
    public $note;

    public function delete()
    {


        try {
            $this->note->delete();
            session()->flash('success', 'یادداشت با موفقیت حذف شد');
            $this->emit('refreshNotes');
        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    public function render()
    {
        return view('livewire.components.note');
    }
}
