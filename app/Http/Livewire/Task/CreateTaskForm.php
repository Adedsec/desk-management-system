<?php

namespace App\Http\Livewire\Task;

use App\Models\CheckList;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateTaskForm extends Component
{

    use WithFileUploads;

    public $list;
    public $project;
    public $desk;

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

    public function mount()
    {
        $this->desk = Auth::user()->activeDesk;
        $this->project = $this->desk->projects()->whereHas('users', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->first();
    }

    public function checklist($value)
    {
        try {
            $this->checklist = $value;

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }

    }


    public function submit()
    {
        $this->validate();

        try {

            dd($this->project);

            $this->project = Project::find($this->project);

            $task = Auth::user()->tasks()->create([
                'desk_id' => $this->desk->id,
                'project_id' => $this->project->id,
                'task_list_id' => $this->list->id ?? null,
                'title' => $this->title,
                'description' => $this->description,
                'deadline' => $this->deadline,
                'order' => ($this->project->withoutListsTasks()->sortByDesc('order')->first()->order ?? 0) + 1

            ]);

            $task->users()->attach($this->users);

            if (!empty($this->checklist)) {
                $check = CheckList::arrayToChecklist($this->checklist);

                $task->check_list_id = $check->id;
            }

            if (!empty($this->attachment)) {
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
            $this->emitUp('taskAdded');
            $this->dispatchBrowserEvent('close-modal', ['id' => 'createTaskModal']);


            return redirect()->back();

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }


    }

    public function render()
    {
        return view('livewire.task.create-task-form');
    }
}
