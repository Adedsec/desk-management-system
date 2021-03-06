<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class CheckListShow extends Component
{
    public $checklist;
    public $item;
    public $task;


    protected $listeners = [
        'refresh' => '$refresh'
    ];


    public function addItem()
    {
        $this->validateOnly('item', [
            'item' => 'required|string'
        ]);


        try {
            if (is_null($this->checklist)) {
                $this->checklist = \App\Models\CheckList::create();
            }
            $this->checklist->items()->create([
                'checked' => 0,
                'content' => $this->item,
                'order' => $this->checklist->lastOrder() + 1
            ]);
            $this->item = '';
            $this->task->check_list_id = $this->checklist->id;
            $this->task->save();
            $this->emitSelf('refresh');

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است');
        }


    }


    public function deleteItem($id)
    {

        try {

            $this->checklist->items()->find($id)->delete();
            $this->emitSelf('refresh');
        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    public function render()
    {
        return view('livewire.components.check-list-show');
    }
}
