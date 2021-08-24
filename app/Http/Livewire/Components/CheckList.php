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

        try {
            array_push($this->checklist, $this->item);
            $this->item = "";
            return back();

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    public function deleteItem($item)
    {

        try {
            array_splice($this->checklist, $item, 1);
            return back();

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    public function render()
    {
        return view('livewire.components.check-list');
    }
}
