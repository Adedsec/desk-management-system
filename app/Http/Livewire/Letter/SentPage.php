<?php

namespace App\Http\Livewire\Letter;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SentPage extends Component
{

    public $desk;
    public $letters;
    public $tag_name;
    public $tags = [];
    public $users = [];

    public $filter_text;
    public $filter_tags = [];
    public $filter_start;
    public $filter_end;


    public $letter_title;
    public $letter_body;

    public function mount()
    {
        $this->letters = Auth::user()->activeDesk->letters()->latest()->where('user_id', Auth::user()->id)->whereDoesntHave('archiveUsers', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->get();
        $this->desk = Auth::user()->activeDesk;


    }

    protected $listeners = [
        'refreshLetters'
    ];

    public function refreshLetters()
    {
        $this->letters = Auth::user()->activeDesk->letters()->latest()->where('user_id', Auth::user()->id)->whereDoesntHave('archiveUsers', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->get();

    }

    public function createTag()
    {
        $this->validate([
            'tag_name' => ['required', 'string', 'max:50']
        ]);


        try {
            $this->desk->tags()->create([
                'name' => $this->tag_name,
                'type' => 'letter'
            ]);

            $this->tag_name = '';

            return redirect()->route('letters.sent');

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }

    }


    public function filter()
    {

        try {
            $this->letters = Auth::user()->activeDesk->letters()->latest()
                ->where('user_id', Auth::user()->id)
                ->whereDoesntHave('archiveUsers', function ($q) {
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

        //$this->emitSelf('refreshLetters');
    }

    public function render()
    {
        return view('livewire.letter.sent-page');
    }
}
