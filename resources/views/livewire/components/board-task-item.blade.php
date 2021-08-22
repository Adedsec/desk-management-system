<div class="" wire:key="task-{{ $task->id }}" wire:sortable-group.item="{{ $task->id }}" style="z-index: 10">
    <div class="d-block text-decoration-none" style="cursor: grab">
        <div class="card {{$task->checked ? 'shadow-sm' : 'shadow'}} my-1">
            <div class="card-body py-2">
                <div class="d-flex mb-1 justify-content-between align-items-center">
                    <div class="d-flex w-100 flex-row justify-content-start ">
                        <input type="checkbox" {{$task->checked ==true ? 'checked' : ''}} wire:model="checked"
                               class="form-check-input">
                        <a type="button" data-bs-target="#viewTaskModal{{$task->id}}" data-bs-toggle="modal">
                            <strong
                                class="card-title mx-1 text-dark {{$task->checked ? ' text-muted disabled text-decoration-line-through' : ''}}  small">{{$task->title}}</strong>
                        </a>

                    </div>
                    <div>
                        <a class="text-danger" href="#deleteModal{{$task->id}}" data-bs-toggle="modal"><i
                                class="bi bi-x-lg"></i></a>
                    </div>
                </div>

                {{--        daedline--}}
                @if (!is_null($task->deadline))
                    <div class="w-100">
                        <span
                            class="badge {{$task->isDelayed() ? 'bg-danger' : 'bg-info' }} p-2 rounded-1">
                             @if ($task->isDelayed())
                                <i class="bi bi-exclamation-circle"></i>
                            @endif
                            مهلت انجام : {{$task->persianDeadline()}}
                        </span>
                    </div>
                @endif
                {{--        tags--}}
                <div class="d-flex mt-1 flex-wrap align-items-center justify-content-start">
                    @foreach($task->tags as $tag)
                        <span class="badge my-1 bg-secondary p-2 small  rounded-1"
                              style="margin-left: 4px">{{$tag->name}}</span>
                    @endforeach

                </div>

                @if ($task->progress != 0)
                    <div class="progress mt-3 mb-1" style="height: 3px">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$task->progress}}%"
                             aria-valuenow="{{$task->progress}}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                @endif

                <div class="d-flex justify-content-start align-items-center0">
                    @foreach($task->users as $user)
                        <div class="d-flex flex-column justify-content-center align-items-center">

                            <img src="{{$user->getAvatar()}}" class="rounded-circle" style="cursor: pointer"
                                 alt="" title="{{$user->name}}"
                                 height="20px" width="20px">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">آیا از حذف وظیفه : <strong
                            class="text-danger">{{$task->title}}</strong> اطمینان دارید
                        ؟</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">خیر</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" wire:click="deleteTask">بله
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewTaskModal{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-body">
                    <livewire:task.edit-task-form :task="$task"/>
                </div>
            </div>
        </div>
    </div>
</div>





