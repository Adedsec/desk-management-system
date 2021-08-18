<?php

namespace App\Http\Livewire\Task;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{

    public $tasks;
    public $desk;

    public $filter_text;
    public $filter_project;
    public $filter_me;
    public $filter_tags = [];

    public function mount()
    {
        $this->desk = Auth::user()->activeDesk;
        $this->tasks = $this->desk->tasks()->orderByDesc('updated_at')->get();
    }

    public function filter()
    {
        $this->tasks = $this->desk->tasks()->orderByDesc('updated_at')->where('title', 'like', '%' . $this->filter_text . '%');
        if (!is_null($this->filter_project) && $this->filter_project != 0) {

            $this->tasks = $this->tasks->where('project_id', $this->filter_project);
        }
        if ($this->filter_me) {
            $this->tasks = $this->tasks->whereHas('users', function ($q) {
                $q->where('user_id', Auth::user()->id);
            });
        }
        if (!empty($this->filter_tags)) {
            $this->tasks = $this->tasks->whereHas('tags', function ($query) {
                $query->whereIn('tag_id', $this->filter_tags);
            });
        }

        $this->tasks = $this->tasks->get();
        //dd($this->tasks);
        //dd($this->filter_text, $this->filter_project, $this->filter_me, $this->filter_tags);

    }

    public function render()
    {
        return view('livewire.task.index');
    }
}
