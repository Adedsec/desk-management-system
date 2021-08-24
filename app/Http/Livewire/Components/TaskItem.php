<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class TaskItem extends Component
{

    public $task;
    public $checked;
    public $checklist;

    public $users = [];

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

    }

    public function updated($name, $value)
    {

        try {
            if ($name == 'checked') {
                $this->task->checked = $value;
                $this->task->save();
            }

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
        dd($this->users);
        $this->task->users()->sync($this->users);
        $this->task->save();
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
        return view('livewire.components.task-item');
    }
}
