<?php

namespace App\Http\Livewire\Project;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskPage extends Component
{

    public $project;
    public $tasks;

    public $filter_text;
    public $filter_project;
    public $filter_me;
    public $filter_tags = [];

    public $users;
    public $editUser = [];

    protected $listeners = [
        //'updateTaskItem' => '$refresh'
    ];

    protected $rules = [
        'project.name' => ['required', 'string', 'max:255']
    ];

    public function mount()
    {
        $this->tasks = $this->project->tasks()->orderByDesc('updated_at')->get();
        $this->users = $this->project->desk->users;
    }

    public function filter()
    {

        try {
            $this->tasks = $this->project->tasks()->orderByDesc('updated_at')->where('title', 'like', '%' . $this->filter_text . '%');
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

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }


    }

    public function updateName()
    {

        try {
            $this->project->save();

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }

    }

    public function render()
    {
        return view('livewire.project.task-page');
    }
}
