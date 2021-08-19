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
                                 alt="{{$user->name}}" title="{{$user->name}}"
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





