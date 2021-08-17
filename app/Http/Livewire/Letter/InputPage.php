<?php

namespace App\Http\Livewire\Letter;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InputPage extends Component
{
    public $letters;
    public $desk;

    public $filter_text;
    public $filter_tags = [];
    public $filter_start;
    public $filter_end;

    protected $listeners = [
        'refreshLetters' => '$refresh'
    ];

    public function mount()
    {
        $this->letters = Auth::user()->activeDesk->letters()->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->where('archived', 0)->get();

        $this->desk = Auth::user()->activeDesk;
    }

    public function filter()
    {
        $this->letters = Auth::user()->activeDesk->letters()->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->where('archived', 0)
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
        $this->emitSelf('refreshLetters');
    }

    public function render()
    {
        return view('livewire.letter.input-page');
    }
}
