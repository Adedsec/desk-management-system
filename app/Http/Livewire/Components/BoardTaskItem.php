<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class BoardTaskItem extends Component
{

    public $task;

    public $checked;

    public $checklist;

    protected $listeners = [
        'updateTaskItem'
    ];

    //refreshes task item
    public function updateTaskItem()
    {
        $this->task->name = $this->task->name;
    }

    public function mount()
    {
        $this->checked = $this->task->checked;
        $this->checklist = $this->task->checklist;
    }


    public function deleteTask()
    {

        try {
            $this->task->delete();
            $this->emit('taskDeleted');

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    // handling complete task
    public function updated($name, $value)
    {
        try {
            if ($name = 'checked') {
                $this->task->checked = $value;
                $this->task->save();
            }

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است');
        }
    }


    // handling progress up button
    public function progressUp()
    {

        try {
            $this->task->progress >= 90
                ? $this->task->progress = 100
                : $this->task->progress += 10;

            $this->task->save();

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    // handling progress down button

    public function progressDown()
    {

        try {
            $this->task->progress <= 10
                ? $this->task->progress = 0
                : $this->task->progress -= 10;

            $this->task->save();

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    public function render()
    {
        return view('livewire.components.board-task-item');
    }
}
