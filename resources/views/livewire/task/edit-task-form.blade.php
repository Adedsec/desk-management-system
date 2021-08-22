<form wire:submit.prevent="updateTask" action="" onkeypress="return event.keyCode != 13;">
    <div class="row">
        <div class="col-md-10">
            <div class="form-floating w-75 text-right ">
                <input type="text" id="title" value="{{$task->title}}"
                       wire:model.defer="task.title"
                       class="form-control border-0 rounded-0 border-bottom  text-right"
                       placeholder="عنوان وظیفه">
                <label for="title" style="left:auto" class="text-right">عنوان وظیفه</label>
            </div>
        </div>
        <div class="col-md-2">
            <a wire:click="updateTask" data-bs-dismiss="modal"
               class="btn btn-outline-danger">ثبت
                تغییرات
            </a>
        </div>
    </div>

    <div class="d-flex mt-2">
        <a href="{{route('projects.show',$task->project->id)}}" class="text-decoration-none">
            <span class="badge bg-warning text-dark p-3">{{$task->project->name}}</span>

        </a>
    </div>


    <div class="d-flex flex-wrap mt-4 flex-row justify-content-start align-items-center">
        @foreach($task->tags as $tag)
            <span class="badge bg-secondary p-2 small  rounded-1"
                  style="margin-left: 4px">{{$tag->name}}</span>
        @endforeach
    </div>
    <div class="d-flex justify-content-between align-items-center">
        @if (!is_null($task->deadline))
            <div class="mt-2">
                                <span
                                    class="badge bg-info p-2 rounded-1">مهلت انجام : {{$task->persianDeadline()}}</span>
            </div>
        @endif
        <div class="d-flex w-50 flex-row justify-content-center align-items-center">
            <a type="button" wire:click="progressDown" class="m-0 text-danger text-bold"
               style="font-size: medium ; font-weight: bold"><i
                    class="bi bi-arrow-right"></i></a>
            <div class="progress  flex-grow-1 px-0 mx-1">
                <div class="progress-bar bg-success" role="progressbar"
                     style="width: {{$task->progress}}%"
                     aria-valuenow="{{$task->progress}}"
                     aria-valuemin="0" aria-valuemax="100">{{$task->progress}} %
                </div>
            </div>
            <a type="button" wire:click="progressUp" class="m-0 text-danger  text-bold"
               style="font-size: medium ; font-weight: bold;"><i
                    class="bi bi-arrow-left"></i></a>
        </div>
    </div>


    <div class="d-flex justify-content-start align-items-start mt-3">
        <button type="button" data-bs-target="#descriptionCollapse{{$task->id}}"
                data-bs-toggle="collapse"
                class="btn btn-outline-primary mx-1"><i class="bi bi-card-text"></i>
        </button>
        <button type="button" data-bs-target="#deadlineCollapse{{$task->id}}"
                data-bs-toggle="collapse"
                class="btn btn-outline-primary mx-1"><i class="bi bi-clock"></i>
        </button>
        <button type="button" class="btn btn-outline-primary mx-1"
                data-bs-target="#checklistCollapse{{$task->id}}"
                data-bs-toggle="collapse"><i class="bi bi-list-check"></i>
        </button>
        <button type="button" data-bs-target="#usersCollapse{{$task->id}}" data-bs-toggle="collapse"
                class="btn btn-outline-primary mx-1"><i class="bi bi-people"></i>
        </button>
        <button type="button" data-bs-target="#tagsCollapse{{$task->id}}" data-bs-toggle="collapse"
                class="btn btn-outline-primary mx-1"><i class="bi bi-tags"></i>
        </button>
        <button type="button" data-bs-target="#attachCollapse{{$task->id}}"
                data-bs-toggle="collapse"
                class="btn btn-outline-primary mx-1"><i class="bi bi-paperclip"></i>
        </button>
    </div>

    <div class="form-group mt-2 collapse" id="descriptionCollapse{{$task->id}}">
        <label for="description">توضیحات : </label>
        <textarea name="description" class="form-control" wire:model.defer="task.description"
                  placeholder="توضیحات " id="description"
                  rows="3">{{$task->description}}</textarea>
    </div>

    <div class="form-group mt-3 collapse" id="deadlineCollapse{{$task->id}}">
        <label for="deadline">مهلت انجام : </label>
        <input type="datetime-local" class="form-control" wire:model.defer="task.deadline"
               value="{{$task->editDeadline()}}"
               id="deadline">
    </div>

    <div class="collapse mt-2 " id="checklistCollapse{{$task->id}}">
        <livewire:components.check-list-show :checklist="$checklist" :task="$task"/>
    </div>

    <div class="form-group mt-2 collapse" id="usersCollapse{{$task->id}}">
        <label for="">
            مسئول انجام :
        </label>
        <div class="d-flex mt-2 flex-wrap justify-content-start align-items-center">
            <ul class="list-group list-group-horizontal">
                @foreach($task->desk->users as $user)
                    <li class="list-group-item text-right rounded-0">

                        <label for="">
                            <input type="checkbox" value="{{$user->id}}" wire:model.defer="users"
                                   {{$task->users->contains($user) ? 'checked' : ''}}
                                   class="form-check-input form-check-inline">
                            {{$user->name}}
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="form-group mt-2 collapse" id="tagsCollapse{{$task->id}}">
        <label for="">
            برچسب ها :
        </label>
        <div class="d-flex mt-2 flex-wrap justify-content-start align-items-center">
            <ul class="list-group list-group-horizontal">

                @foreach(\App\Models\Tag::getTaskAvailableTags() as $tag)
                    <li class="list-group-item text-right rounded-0 ">
                        <label for="">
                            <input type="checkbox" value="{{$tag->id}}" wire:model.defer="tags"
                                   {{$task->tags->contains($tag) ? 'checked' : ''}}
                                   class="form-check-input form-check-inline">
                            <span class="badge bg-info p-1">{{$tag->name}}</span>
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="form-group mt-2 collapse" id="attachCollapse{{$task->id}}">
        <label for="">
            پیوست :
        </label>
        <div class="list-group w-100">
            @foreach($task->attachments as $attach)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{$attach->link}}" class="">{{$attach->name}}</a>
                    <a class="p-0 m-0 text-danger" wire:click="deleteAttachment({{$attach->id}})" type="button"><i
                            class="bi bi-x-lg"></i></a>
                </li>
            @endforeach
        </div>
        <div class="mt-2">
            <input type="file" wire:model.defer="attachment" multiple class="form-control">
        </div>
    </div>

</form>
