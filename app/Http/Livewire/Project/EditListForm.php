<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;

class EditListForm extends Component
{

    public $list;

    public $title;

    public $color;


    public function mount()
    {
        $this->title = $this->list->title;
        $this->color = $this->list->color;
    }

    public function edit()
    {
        $this->list->title = $this->title;
        $this->list->color = $this->color;

        $this->list->save();
        $this->emit('listAdded');
    }

    public function render()
    {
        return view('livewire.project.edit-list-form');
    }
}
