<?php

namespace App\Http\Livewire\Letter;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ArchivePage extends Component
{

    public $letters;
    public $desk;

    public $filter_text;
    public $filter_tags = [];
    public $filter_start;
    public $filter_end;

    protected $listeners = [
        'refreshLetters'
    ];

    public function mount()
    {
        $this->desk = Auth::user()->activeDesk;
        $this->letters = Auth::user()->archivedLetters->where('desk_id', $this->desk->id);
    }

    public function refreshLetters()
    {
        $this->letters = Auth::user()->archivedLetters->where('desk_id', $this->desk->id);

    }

    public function filter()
    {

        $this->letters = Auth::user()->archivedLetters()->where('desk_id', $this->desk->id)
            ->where('title', 'like', '%' . $this->filter_text . '%');

        if (!empty($this->filter_tags)) {
            $this->letters = $this->letters->whereHas('tags', function ($query) {
                $query->whereIn('tag_id', $this->filter_tags);
            });
        }
        if (!is_null($this->filter_start)) {
            $this->letters = $this->letters->where('created_at', '>=', $this->filter_start);
        }
        if (!is_null($this->filter_end)) {
            $this->letters = $this->letters->where('created_at', '<=', $this->filter_end);
        }
        $this->letters = $this->letters->get();
    }

    public function render()
    {
        return view('livewire.letter.archive-page');
    }
}
