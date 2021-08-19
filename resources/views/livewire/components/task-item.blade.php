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

                @if (!is_null($task->deadline))
                    <span
                        class="badge {{$task->isDelayed() ? 'bg-danger' : 'bg-success' }} p-2 rounded-1">
                             @if ($task->isDelayed())
                            <i class="bi bi-exclamation-circle"></i>
                        @endif
                        {{$task->persianDeadline()}}
                        </span>
                @endif

                @if (!is_null($task->check_list_id))
                    <i class="bi bi-check-all text-success p-1"></i>
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
                    <form action="" onkeypress="return event.keyCode != 13;">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-floating w-75 text-right ">
                                    <input type="text" id="title" value="{{$task->title}}"
                                           class="form-control border-0 rounded-0 border-bottom  text-right"
                                           placeholder="عنوان وظیفه">
                                    <label for="title" style="left:auto" class="text-right">عنوان وظیفه</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-outline-danger">ثبت تغییرات</button>
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
                            <textarea name="description" class="form-control" placeholder="توضیحات " id="description"
                                      rows="3">{{$task->description}}</textarea>
                        </div>

                        <div class="form-group mt-3 collapse" id="deadlineCollapse{{$task->id}}">
                            <label for="deadline">مهلت انجام : </label>
                            <input type="datetime-local" class="form-control"
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
                                @foreach($task->desk->users as $user)
                                    <li class="list-group-item">

                                        <label for="">
                                            {{$user->name}}
                                            <input type="checkbox" value="{{$user->id}}"
                                                   {{$task->users->contains($user) ? 'checked' : ''}}
                                                   class="form-check-input form-check-inline">
                                        </label>
                                    </li>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group mt-2 collapse" id="tagsCollapse{{$task->id}}">
                            <label for="">
                                برچسب ها :
                            </label>
                            <div class="d-flex mt-2 flex-wrap justify-content-start align-items-center">
                                @foreach(\App\Models\Tag::getTaskAvailableTags() as $tag)
                                    <li class="list-group-item">

                                        <label for="">
                                            {{$tag->name}}
                                            <input type="checkbox" value="{{$tag->id}}"
                                                   {{$task->tags->contains($tag) ? 'checked' : ''}}
                                                   class="form-check-input form-check-inline">
                                        </label>
                                    </li>
                                @endforeach
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
                                        <a class="p-0 m-0 text-danger" type="button"><i class="bi bi-x-lg"></i></a>
                                    </li>
                                @endforeach
                            </div>
                            <div class="mt-2">
                                <input type="file" multiple class="form-control">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


