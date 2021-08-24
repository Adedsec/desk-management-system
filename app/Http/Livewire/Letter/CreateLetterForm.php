<?php

namespace App\Http\Livewire\Letter;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateLetterForm extends Component
{

    public $desk;


    public $letter_title;
    public $letter_body;
    public $users = [];

    public $tags = [];


    public function rules()
    {
        return [
            'letter_title' => ['required', 'string', 'max:200'],
            'letter_body' => ['required', 'string'],
            'users' => ['array', Rule::in($this->desk->users)]
        ];
    }

    public function mount()
    {
        $this->desk = Auth::user()->activeDesk;
    }

    public function createLetter()
    {
        $this->validate([
            'letter_title' => ['required', 'string', 'max:255'],
            'letter_body' => ['required', 'string'],
            'users' => ['required']
        ]);

        try {
            $letter_tmp = $this->desk->letters()->create([
                'title' => $this->letter_title,
                'body' => $this->letter_body,
                'user_id' => Auth::user()->id
            ]);
            $letter_tmp->tags()->attach($this->tags);
            $letter_tmp->users()->attach($this->users);
            $this->emit('refreshLetters');

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }

    }

    public function letterCancel()
    {
        $this->letter_title = null;
        $this->letter_body = null;
        $this->emit('refreshLetters');

    }

    public function render()
    {
        return view('livewire.letter.create-letter-form');
    }
}
