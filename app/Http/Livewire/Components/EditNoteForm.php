<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class EditNoteForm extends Component
{
    public $note;

    public $title;

    public $body;

    protected $rules = [
        'title' => ['required', 'string', 'max:255'],
        'body' => ['required', 'string']
    ];

    public function mount()
    {
        $this->title = $this->note->title;
        $this->body = $this->note->body;
    }

    public function store()
    {
        $this->validate();
        $this->note->title = $this->title;
        $this->note->body = $this->body;
        $this->note->save();
        $this->emit('refreshNotes');
        session()->flash('message', 'بروزرسانی انجام شد');
    }

    public function render()
    {
        return view('livewire.components.edit-note-form');
    }
}
