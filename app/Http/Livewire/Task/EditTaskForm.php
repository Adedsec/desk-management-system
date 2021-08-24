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

    protected $listeners = [
        'updateTaskItem' => '$refresh'
    ];

    public function mount()
    {
        $this->checked = $this->task->checked;
        $this->checklist = $this->task->checklist;

        foreach ($this->task->tags as $tag) {
            $this->tags[$tag->id] = true;
        }
        foreach ($this->task->users as $user) {
            $this->users[$user->id] = true;
        }

    }

    public function deleteAttachment($id)
    {

        try {

            $attach = Attachment::find($id);
            Storage::delete($attach->link);
            $attach->delete();
        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }

    }

    public function progressUp()
    {

        try {
            $this->task->progress >= 90
                ? $this->task->progress = 100
                : $this->task->progress += 10;

            $this->task->save();

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }

    }

    public function updateTask()
    {


        try {
            $this->task->users()->sync(array_keys(array_filter($this->users)));
            $this->task->tags()->sync(array_keys(array_filter($this->tags)));

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

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }


    }

    public function progressDown()
    {

        try {
            $this->task->progress <= 10
                ? $this->task->progress = 0
                : $this->task->progress -= 10;

            $this->task->save();

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }


    }

    public function render()
    {
        return view('livewire.task.edit-task-form');
    }
}
