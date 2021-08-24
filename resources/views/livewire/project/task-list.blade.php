<li class="list-group-item border-0 mx-1 bg-transparent col-md-2 p-0 rounded-3"
    wire:key="list-{{$list->id??0 . rand()}}"
    wire:sortable.item="{{$list->id ??0}}"
    style="width: 20%;height: 80vh">
    <div class="d-flex flex-column h-100">
        <div class="rounded-2 bg-success mb-1 d-flex justify-content-between  align-items-center"
             wire:sortable.handle
             style="height: 32px;cursor: grab">
            <div class="m-3">
                @if (is_null($list))
                    <strong class="text-light">برای انجام ({{$project->withoutListTasksCount()}})</strong>
                @else
                    <strong class="text-light">{{$list->title}}({{$list->tasksCount()}})</strong>
                @endif
            </div>

            {{--            list settings--}}
            @if (!is_null($list))
                @can('manage_lists')
                    <div class="dropdown">

                        <button type="button" class="btn bg-transparent  text-light m-0 p-0"
                                id="listDropdownButton{{is_null($list) ? 0 :$list->id}}"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <i class="bi  mx-2 pt-2 bi-three-dots"
                               style="font-size: 20px"></i>
                        </button>

                        <ul class="dropdown-menu text-right"
                            aria-labelledby="#listDropdownButton{{is_null($list) ? 0 :$list->id}}"
                            id="listDropdown">
                            <li>
                                <button class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#editListModal{{is_null($list) ? 0 :$list->id}}">
                                    ویرایش
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteListModal{{$list->id}}">
                                    حذف
                                </button>
                            </li>
                        </ul>
                    </div>
                @endcan
            @endif

        </div>

        @can('manage_task')
            <a href="#" type="button" data-bs-target="#createTaskModal{{is_null($list) ? 0 :$list->id}}"
               data-bs-toggle="modal"
               class="text-decoration-none">
                <div class="rounded-2  mb-1 d-flex justify-content-center align-items-center"
                     style="height: 28px; background-color: #d0cfcf">
                    <div class="m-3">
                        <div class="text-secondary">ایجاد وظیفه جدید</div>
                    </div>
                </div>
            </a>
        @endcan

        <div class="h-100" wire:sortable-group.item-group="{{ $list->id ?? 0 }}">
            @if (is_null($list))
                @foreach($project->tasks->where('task_list_id',0)->sortBy('order') as $task)
                    <livewire:components.board-task-item :task="$task" :key="'task-'.$task->id.rand()"/>
                @endforeach
            @else
                @foreach($list->tasks->sortBy('order') as $task)
                    <livewire:components.board-task-item :task="$task" :key="'task-'.$task->id.rand()"/>
                @endforeach
            @endif
        </div>


    </div>


    @if (!is_null($list))
        {{--        edit list modal--}}
        <div class="modal fade" id="editListModal{{is_null($list) ? 0 :$list->id}}" tabindex="-1"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ویرایش لیست </h5>
                    </div>
                    <div class="modal-body">
                        <livewire:project.edit-list-form :list="$list"/>
                    </div>
                </div>
            </div>
        </div>

        {{--        delete list modal--}}

        @if ($list->deletable())

            <div class="modal fade" id="deleteListModal{{$list->id}}" tabindex="-1"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">از حذف لیست اطمینان دارید ؟</h5>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">خیر</button>
                            <button type="button" class="btn btn-danger" wire:click="deleteList"
                                    data-bs-dismiss="modal">بله
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        @else

            <div class="modal fade" id="deleteListModal{{$list->id}}" tabindex="-1"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">لیست به دلیل وجود وظیفه قابل حذف نیست</h5>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بازگشت</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    {{--            create Task modal--}}

    <div class="modal fade" id="createTaskModal{{is_null($list) ? 0 :$list->id}}" tabindex="-1"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ایجاد وظیفه جدید</h5>
                </div>
                <div class="modal-body">
                    <livewire:project.create-task-form :list="$list" :project="$project"/>
                </div>
            </div>
        </div>
    </div>
</li>
