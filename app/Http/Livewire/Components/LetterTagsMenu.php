<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LetterTagsMenu extends Component
{
    public $name;
    public $type = 'letter';

    protected $rules = [
        'name' => ['required', 'string', 'max:50']
    ];


    public function updated($name, $value)
    {
        $this->validateOnly($name);
    }

    public function store()
    {
        $this->validate();

        Auth::user()->activeDesk->tags()->create([
            'name' => $this->name,
            'type' => $this->type
        ]);
        $this->emit('tagAdded');
        session()->flash('success', 'برچسب با موفقیت ایجاد شد');
    }

    public function render()
    {
        return view('livewire.components.letter-tags-menu');
    }
}
