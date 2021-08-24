<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;

class TaskList extends Component
{

    public $project;
    public $list;


    protected $listeners = [
        'taskDeleted' => '$refresh',
        'refreshBoard' => '$refresh',
        'taskAdded'
    ];



    public function taskAdded()
    {
        $this->project->refresh();
    }

    public function deleteList()
    {

        try {
            $this->list->delete();
            $this->emit('listAdded');

        } catch (\Exception $exception) {
            session()->flash('error', 'مشکلی در انجام عملیات رخ داده است !');
        }

    }

    public function render()
    {
        return view('livewire.project.task-list');
    }
}
