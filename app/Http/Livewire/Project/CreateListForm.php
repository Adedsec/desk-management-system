<?php

namespace App\Http\Livewire\Project;

use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateListForm extends Component
{

    public $project;

    public $title;

    public $rules = [
        'title' => ['required', 'string', 'max:255'],
    ];

    public function store()
    {
        $this->validate();
        $order = $this->project->lastListOrder() + 1;
        $this->project->lists()->create([
            'title' => $this->title,
            'order' => $order,
        ]);
        $this->emit('listAdded');
    }


    public function updated($name, $value)
    {
        $this->validateOnly($name);
    }

    public function render()
    {
        return view('livewire.project.create-list-form');
    }
}
