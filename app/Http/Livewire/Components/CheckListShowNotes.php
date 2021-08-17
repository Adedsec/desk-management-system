<?php

namespace App\Http\Livewire\Components;

use App\Models\CheckListItem;
use Livewire\Component;

class CheckListShowNotes extends Component
{

    public $checklist;
    public $item;
    public $note;

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public function mount()
    {
        $this->checklist = $this->note->checklist;
    }


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
        $this->note->check_list_id = $this->checklist->id;
        $this->note->save();
        $this->emitSelf('refresh');

    }


    public function deleteItem($id)
    {
        $this->checklist->items()->find($id)->delete();
        $this->emitSelf('refresh');
    }

    public function toggleChecked($id)
    {
        $item = CheckListItem::find($id);
        if ($item->checked) {
            $item->checked = false;
        } else {
            $item->checked = true;
        }

        $item->save();
        $this->emitSelf('refresh');

    }

    public function render()
    {
        return view('livewire.components.check-list-show-notes');
    }
}
