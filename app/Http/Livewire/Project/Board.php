<?php

namespace App\Http\Livewire\Project;

use App\Models\Task;
use Livewire\Component;

class Board extends Component
{

    public $project;

    protected $listeners = [
        'listAdded' => '$refresh',
        'refreshBoard' => '$refresh',
        'taskAdded' => '$refresh'
    ];


    public function updateListOrder($lists)
    {

        try {
            foreach ($lists as $list) {
                if ($list['value'] != '0') {
                    $tmp = $this->project->lists()->find($list['value']);
                    $tmp->order = $list['order'];
                    $tmp->save();
                }
            }
            return redirect()->route('project.board', $this->project->id);

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }


    }

    public function updateTaskOrder($lists)
    {

        try {
            foreach ($lists as $list) {
                $tmp = $this->project->lists()->find($list['value']);
                foreach ($list['items'] as $item) {
                    $task = Task::find($item['value']);
                    $task->task_list_id = $tmp->id ?? null;
                    $task->order = $item['order'];
                    $task->save();
                }
            }

            $this->emit('refreshBoard');

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }


    }

    public function render()
    {
        return view('livewire.project.board');
    }
}
