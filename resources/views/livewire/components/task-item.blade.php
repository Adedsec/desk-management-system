<div>
    <div class="text-decoration-none text-dark d-block">
        <div class="w-100 shadow-sm card py-2 my-1 flex-row  d-flex justify-content-between align-items-center">

            <div class="d-flex  flex-row align-items-center justify-content-start" style="width: 30%">
                <div class="mx-2">
                    <input type="checkbox" {{$task->checked ==true ? 'checked' : ''}} wire:model="checked"
                           class="form-check-input form-check-inline" style="width: 20px; height: 20px">
                </div>

                @if ($task->progress !=0)
                    <div class="progress mx-3" style="width: 20%">
                        <div class="progress-bar  bg-success" role="progressbar" style="width: {{$task->progress}}%;"
                             aria-valuenow="25"
                             aria-valuemin="0"
                             aria-valuemax="100">{{$task->progress}}
                        </div>
                    </div>
                @endif

                <a type="button" data-bs-target="#TaskModal{{$task->id}}"
                   data-bs-toggle="modal">
                    <div class="mx-1 {{$task->checked ? ' text-muted disabled text-decoration-line-through' : ''}}">
                        {{$task->title}}
                    </div>
                </a>

            </div>
            <div class="d-flex  flex-row align-items-center justify-content-start">

                @if (!is_null($task->check_list_id))
                    <i class="bi bi-check-all text-success p-1"></i>
                @endif

                @if (!is_null($task->deadline))
                    <span
                        class="badge {{$task->isDelayed() ? 'bg-danger' : 'bg-success' }} p-2 rounded-1">
                             @if ($task->isDelayed())
                            <i class="bi bi-exclamation-circle"></i>
                        @endif
                        {{$task->persianDeadline()}}
                        </span>
                @endif


                <div class="mx-2">

                    @foreach($task->tags as $tag)
                        <span class="badge bg-info p-2">{{$tag->name}}</span>
                    @endforeach

                </div>


                <div class="small mx-2">
                    @foreach($task->users as $user)
                        <img src="{{$user->getAvatar()}}" class="rounded-circle" alt="user" title="{{$user->name}}"
                             width="30px" height="30px">
                    @endforeach
                </div>
            </div>


        </div>
    </div>
    <div class="modal fade" id="TaskModal{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
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


