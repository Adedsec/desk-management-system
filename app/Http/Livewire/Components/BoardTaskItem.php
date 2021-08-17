<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class BoardTaskItem extends Component
{

    public $task;

    public $checked;

    public $checklist;

    public function mount()
    {
        $this->checked = $this->task->checked;
        $this->checklist = $this->task->checklist;
    }


    public function deleteTask()
    {
        $this->task->delete();
    }

    public function updated($name, $value)
    {
        if ($name = 'checked') {
            $this->task->checked = $value;
            $this->task->save();
        }
    }

    public function progressUp()
    {
        $this->task->progress >= 90
            ? $this->task->progress = 100
            : $this->task->progress += 10;

        $this->task->save();
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
        return view('livewire.components.board-task-item');
    }
}
