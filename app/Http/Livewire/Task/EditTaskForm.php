<?php

namespace App\Http\Livewire\Task;

use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditTaskForm extends Component
{

    use WithFileUploads;

    public $task;

    public $checklist;

    public $users = [];
    public $tags = [];
    public $attachment;

    protected $rules = [
        'task.title' => ['required', 'string'],
        'task.description' => ['string'],
        'task.deadline' => ['nullable', 'date', 'after:now'],
    ];

    public function mount()
    {
        $this->checked = $this->task->checked;
        $this->checklist = $this->task->checklist;
    }

    public function deleteAttachment($id)
    {
        //$this->task->attachments()->detach();
        $attach = Attachment::find($id);
        Storage::delete($attach->link);
        $attach->delete();
    }

    public function progressUp()
    {
        $this->task->progress >= 90
            ? $this->task->progress = 100
            : $this->task->progress += 10;

        $this->task->save();
    }

    public function updateTask()
    {
        if (!empty($this->users))
            $this->task->users()->sync($this->users);
        $this->task->tags()->sync($this->tags);

        if (!empty($this->attachment)) {
            foreach ($this->attachment as $item) {
                $this->task->attachments()->create([
                    'name' => $item->getClientOriginalName(),
                    'type' => explode('.', $item->getClientOriginalName())[1],
                    'link' => '/storage/' . $item->store('attachments', 'public')
                ]);
            }
        }

        $this->task->save();

        $this->emit('updateTaskItem');

    }

    public function progressDown()
    {
        $this->task->progress <= 10
            ? $this->task->progress = 0
            : $this->task->progress -= 10;

        $this->task->save();


    }

    public function render()
    {
        return view('livewire.task.edit-task-form');
    }
}
