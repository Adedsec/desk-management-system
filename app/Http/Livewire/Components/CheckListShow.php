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

    }




    public function deleteItem($id)
    {
        $this->checklist->items()->find($id)->delete();
        $this->emitSelf('refresh');
    }

    public function render()
    {
        return view('livewire.components.check-list-show');
    }
}
