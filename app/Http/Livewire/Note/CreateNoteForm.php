<?php

namespace App\Http\Livewire\Note;

use App\Models\CheckList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateNoteForm extends Component
{

    use WithFileUploads;

    public $title;
    public $body;
    public $image;
    public $color = 'white';
    public $checklist = [];


    protected $rules = [
        'title' => ['required', 'string', 'max:255'],
        'body' => ['required', 'string'],
        'image' => ['image', 'max:2048']
    ];

    protected $listeners = [
        'checklist'
    ];

    public function checklist($value)
    {
        $this->checklist = $value;
    }

    public function updated($name, $value)
    {
        $this->validateOnly($name);
    }

    public function store()
    {


        $this->validate();
        $check = null;
        if (!empty($this->checklist)) {
            $check = CheckList::arrayToChecklist($this->checklist)->id;
        }

        $note = Auth::user()->activeDesk->notes()->create([
            'title' => $this->title,
            'body' => $this->body,
            'image' => is_null($this->image) ? null : '/storage/' . $this->image->store('notes', 'public'),
            'color' => $this->color,
            'user_id' => Auth::user()->id,
            'check_list_id' => $check
        ]);

        $this->emit('refreshNotes');
        return back();
    }

    public function render()
    {
        return view('livewire.note.create-note-form');
    }
}
