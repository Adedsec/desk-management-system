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
        $this->letters = Auth::user()->activeDesk->letters()->where('user_id', Auth::user()->id)->where('archived', 0)->get();
        $this->desk = Auth::user()->activeDesk;
    }

    protected $listeners = [
        'refreshLetters' => '$refresh'
    ];

    public function createTag()
    {
        $this->validate([
            'tag_name' => ['required', 'string', 'max:50']
        ]);
        $this->desk->tags()->create([
            'name' => $this->tag_name,
            'type' => 'letter'
        ]);

        $this->emitSelf('refreshLetters');
        $this->tag_name = '';
    }


    public function createLetter()
    {
        $this->validate([
            'letter_title' => ['required', 'string', 'max:255'],
            'letter_body' => ['required', 'string'],
            'users' => ['required']
        ]);

        $letter_tmp = $this->desk->letters()->create([
            'title' => $this->letter_title,
            'body' => $this->letter_body,
            'user_id' => Auth::user()->id
        ]);
        $letter_tmp->tags()->attach($this->tags);
        $letter_tmp->users()->attach($this->users);
        $this->emitSelf('refreshLetters');
    }

    public function letterCancel()
    {
        $this->letter_title = null;
        $this->letter_body = null;
    }

    public function filter()
    {
        $this->letters = Auth::user()->activeDesk->letters()
            ->where('user_id', Auth::user()->id)
            ->where('archived', 0)
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
        return view('livewire.letter.sent-page');
    }
}
