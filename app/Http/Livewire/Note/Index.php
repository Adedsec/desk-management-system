<?php

namespace App\Http\Livewire\Note;

use App\Models\Desk;
use App\Models\Note;
use Livewire\Component;

class Index extends Component
{

    public $desk;
    public $notes;

    public $filter_tags = [];
    public $filter_text;

    public $tag_name;

    protected $listeners = [
        'refreshNotes' => '$refresh'
    ];

    protected $rules = [
        'tag_name' => ['required', 'string', 'max:50']
    ];

    public function mount()
    {
        $this->notes = $this->desk->notes;
    }


    public function createTag()
    {
        $this->validate();
        $this->desk->tags()->create([
            'name' => $this->tag_name,
            'type' => 'note'
        ]);

        $this->emitSelf('refreshNotes');

        $this->tag_name = '';
    }

    public function filter()
    {
        $this->notes = $this->desk->notes()->where('title', 'like', '%' . $this->filter_text . '%');
        if (!empty($this->filter_tags)) {
            $this->notes = $this->notes->whereHas('tags', function ($query) {
                $query->whereIn('tag_id', $this->filter_tags);
            });
        }

        $this->notes = $this->notes->get();
    }

    public function render()
    {
        return view('livewire.note.index');
    }
}
