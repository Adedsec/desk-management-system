<?php

namespace App\Http\Livewire\Project;

use App\Models\Task;
use Livewire\Component;

class Board extends Component
{

    public $project;

    protected $listeners = [
        'listAdded' => '$refresh',
        'refreshBoard' => '$refresh'
    ];




    public function updateListOrder($lists)
    {
        foreach ($lists as $list) {
            if ($list['value'] != '0') {
                $tmp = $this->project->lists()->find($list['value']);
                $tmp->order = $list['order'];
                $tmp->save();
            }
        }
        return redirect()->route('project.board', $this->project->id);

    }

    public function updateTaskOrder($lists)
    {
        foreach ($lists as $list) {
            $tmp = $this->project->lists()->find($list['value']);
            foreach ($list['items'] as $item) {
                $task = Task::find($item['value']);
                $task->task_list_id = $tmp->id ?? null;
                $task->order = $item['order'];
                $task->save();
            }
        }
    }

    public function render()
    {
        return view('livewire.project.board');
    }
}
