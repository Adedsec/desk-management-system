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
    }

    public function render()
    {
        return view('livewire.project.edit-list-form');
    }
}
