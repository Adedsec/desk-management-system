<?php

namespace App\Http\Livewire\Project;

use App\Models\CheckList;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateTaskForm extends Component
{

    use WithFileUploads;

    public $list;
    public $project;

    public $title;
    public $description;
    public $deadline;

    public $attachment;

    public $users = [];

    public $checklist = [];

    protected $rules = [
        'title' => ['required', 'string'],
    ];


    protected $listeners = [
        'checklist'
    ];

    public function checklist($value)
    {
        $this->checklist = $value;
    }


    public function submit()
    {
        $this->validate();

        $task = Auth::user()->tasks()->create([
            'desk_id' => $this->project->desk->id,
            'project_id' => $this->project->id,
            'task_list_id' => $this->list->id,
            'title' => $this->title,
            'description' => $this->description,
            'deadline' => $this->deadline,
            'order' => (Task::orderByDesc('order')->first()->order ?? 0) + 1
        ]);

        $task->users()->attach($this->users);

        $check = CheckList::arrayToChecklist($this->checklist);

        $task->check_list_id = $check->id;

        $task->save();

        return back();


    }

    public function render()
    {
        return view('livewire.project.create-task-form');
    }
}
