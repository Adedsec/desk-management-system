<?php

namespace App\Http\Livewire\Letter;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ParaphPage extends Component
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

    public function refreshLetters()
    {
        $this->letters = Auth::user()->activeDesk->letters()->latest()->whereHas('paraphs', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->whereDoesntHave('archiveUsers', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->get();
    }

    public function mount()
    {
        $this->letters = Auth::user()->activeDesk->letters()->latest()->whereHas('paraphs', function ($query) {
            $query->where('user_id', Auth::user()->id)
                ->orwhereHas('users', function ($q) {
                    $q->where('user_id', Auth::user()->id);
                });

        })->whereDoesntHave('archiveUsers', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->get();

        $this->desk = Auth::user()->activeDesk;
    }

    public function filter()
    {

        try {

            $this->letters = Auth::user()->activeDesk->letters()->latest()->whereHas('users', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->whereDoesntHave('archiveUsers', function ($q) {
                $q->where('user_id', Auth::user()->id);
            })
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
        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }

    }

    public function render()
    {
        return view('livewire.letter.paraph-page');
    }
}
