<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskTagsMenu extends Component
{

    public $name;
    public $type = 'task';

    protected $rules = [
        'name' => ['required', 'string', 'max:50']
    ];


    public function updated($name, $value)
    {
        $this->validateOnly($name);
    }

    public function store()
    {
        $this->validate();


        try {
            Auth::user()->activeDesk->tags()->create([
                'name' => $this->name,
                'type' => $this->type
            ]);
            session()->flash('success', 'برچسب با موفقیت ایجاد شد');

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }

    }

    public function render()
    {
        return view('livewire.components.task-tags-menu');
    }
}
