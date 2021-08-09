<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class CheckList extends Component
{

    public $checklist = [];
    public $item = '';

    protected $rules = [
        'item' => ['string', 'required']
    ];

    public function updated($name)
    {

    }

    public function save()
    {

        $this->emit('checklist', $this->checklist);
    }

    public function addItem()
    {
        $this->validateOnly('item');
        array_push($this->checklist, $this->item);
        $this->item = "";
        return back();
    }

    public function deleteItem($item)
    {
        array_splice($this->checklist, $item, 1);
        return back();
    }

    public function render()
    {


        return view('livewire.components.check-list');
    }
}
