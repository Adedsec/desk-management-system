<?php

namespace App\Http\Livewire\Project;

use App\Models\CheckList;
use App\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Psy\Util\Str;
use function PHPUnit\Framework\isEmpty;

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


    public $tags = [];

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
            'task_list_id' => $this->list->id ?? null,
            'title' => $this->title,
            'description' => $this->description,
            'deadline' => $this->deadline,
            'order' => (Task::orderByDesc('order')->first()->order ?? 0) + 1
        ]);

        $task->users()->attach($this->users);

        if (!isEmpty($this->checklist)) {
            $check = CheckList::arrayToChecklist($this->checklist);

            $task->check_list_id = $check->id;
        }

        if (!isEmpty($this->attachment)) {
            foreach ($this->attachment as $item) {
                $task->attachments()->create([
                    'name' => $item->getClientOriginalName(),
                    'type' => explode('.', $item->getClientOriginalName())[1],
                    'link' => '/storage/' . $item->store('attachments', 'public')
                ]);
            }
        }

        $task->tags()->attach($this->tags);

        $task->save();

        return back();


    }

    public function render()
    {
        return view('livewire.project.create-task-form');
    }
}