<?php

namespace App\Http\Livewire\Project;

use App\Models\CheckList;
use App\Models\Task;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Arr;
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


        try {
            $task = Auth::user()->tasks()->create([
                'desk_id' => $this->project->desk->id,
                'project_id' => $this->project->id,
                'task_list_id' => $this->list->id ?? null,
                'title' => $this->title,
                'description' => $this->description,
                'deadline' => $this->deadline,
                'order' => is_null($this->list)
                    ? ($this->project->withoutListsTasks()->sortByDesc('order')->first()->order ?? 0) + 1
                    : ($this->list->tasks()->orderByDesc('order')->first()->order ?? 0) + 1
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
            $this->dispatchBrowserEvent('close-modal-board', ['id' => 'createTaskModal' . $this->list->id ?? 0]);


            return back();
        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }


    }

    public function render()
    {
        return view('livewire.project.create-task-form');
    }
}
