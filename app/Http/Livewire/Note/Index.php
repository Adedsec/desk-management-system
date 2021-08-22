<?php

namespace App\Http\Livewire\Note;

use App\Models\Desk;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{

    public $desk;
    public $notes;

    public $filter_tags = [];
    public $filter_text;

    public $tag_name;

    protected $listeners = [
        'refreshNotes'
    ];

    protected $rules = [
        'tag_name' => ['required', 'string', 'max:50']
    ];

    public function mount()
    {
        $this->notes = Auth::user()->notes->where('desk_id', $this->desk->id);
    }

    public function refreshNotes()
    {
        $this->notes = Auth::user()->notes->where('desk_id', $this->desk->id);

    }


    public function createTag()
    {
        $this->validate();
        $this->desk->tags()->create([
            'name' => $this->tag_name,
            'type' => 'note'
        ]);

        $this->emitSelf('refreshNotes');
        $this->emit('refreshCreateForm');

        $this->tag_name = '';
    }

    public function filter()
    {
        $this->notes = Auth::user()->notes()->where('desk_id', $this->desk->id)->where('title', 'like', '%' . $this->filter_text . '%');
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
