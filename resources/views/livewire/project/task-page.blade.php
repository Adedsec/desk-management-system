<div class="row mt-4 pb-5 vh-84">
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        پروژه:
                        {{$project->name}}
                        <a href="#editNameModal" data-bs-toggle="modal"><span class="text-primary"><i
                                    class="bi bi-pencil"></i></span></a>
                    </h5>

                    @role('admin')
                    <button data-bs-target="#deleteProjectModal" data-bs-toggle="modal"
                            class="btn btn-danger text-light">حذف پروژه
                    </button>
                    <div class="modal" id="deleteProjectModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">آیا از حذف پروژه اطمینان دارید ؟</h5>
                                </div>
                                <div class="modal-body">
                                    <p>درصورت حذف پروژه تمامی وظایف مربوط به آن حذف خواهد شد !</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو
                                    </button>
                                    <a href="{{route('project.delete',$project->id)}}" type="button"
                                       class="btn btn-danger text-light">حذف</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endrole
                </div>


                <p class="card-title mt-4">
                    وضعیت کلی :
                </p>
                <div class="progress mt-3" style="height: 5px">
                    <div class="progress-bar bg-success" role="progressbar"
                         title="انجام شده : {{$project->generalProgress()}}%"
                         style="width: {{$project->generalProgress()}}%"
                         aria-valuenow="{{$project->generalProgress()}}"
                         aria-valuemin="0"
                         aria-valuemax="100"></div>
                    <div class="progress-bar bg-danger" title="دارای تاخبر : {{$project->delayedProgress()}}%"
                         role="progressbar"
                         style="width: {{$project->delayedProgress()}}%"
                         aria-valuenow="{{$project->delayedProgress()}}"
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="d-flex mt-3 justify-content-between align-items-baseline">
                    <p class="card-text small">
                        انجام شده :
                        {{$project->completedTasksCount()}}
                    </p>
                    <p class="card-text small">
                        انجام نشده :
                        {{$project->allTasksCount()-$project->completedTasksCount()}}
                    </p>
                    <p class="card-text small" style="padding-left: 5px">
                        دارای تاخیر :
                        {{$project->delayTasksCount()}}
                    </p>
                </div>

                <p class="card-title mt-4">
                    اعضای پروژه :
                </p>

                <div class="d-flex justify-content-start align-items-center flex-wrap">
                    @foreach($project->users as $user)
                        <div class="d-flex m-2 flex-column justify-content-center align-items-center">
                            <img src="{{$user->getAvatar()}}" alt="" class="rounded-circle" width="40px"
                                 height="40px">
                            <p class="small">{{$user->name}}</p>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button data-bs-target="#addUserModal" data-bs-toggle="modal" class="btn btn-outline-success">
                        تغییر اعضا
                    </button>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-9">
        <div class="d-flex justify-content-start align-items-start">

            <button class="btn btn-outline-dark mx-3" data-bs-target="#createTaskModal" data-bs-toggle="modal">
                <i class="bi bi-plus-lg"></i>
                ایجاد وظیفه
            </button>

            <button class="btn btn-outline-primary" data-bs-target="#filterCollapse" data-bs-toggle="collapse">فیلتر
            </button>
            <div class="flex-grow-1 mx-4 mt-2">
                <div class="collapse" id="filterCollapse">
                    <div class="card">
                        <div class="card-body">
                            <form action="" wire:submit.prevent="filter">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-control-sm"
                                               wire:model.defer="filter_text" placeholder="عنوان ">
                                    </div>

                                    <div class="col-md-5 form-check form-switch">
                                        <label class="form-check-label" for="">
                                            <input type="checkbox" wire:model.defer="filter_me"
                                                   class="form-check-input form-check-inline">
                                            فقط وظایف من را نمایش بده
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-outline-dark" type="submit">اعمال فیلتر</button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <p>برچسب : </p>
                                    <div class="d-flex justify-content-start align-items-center flex-wrap">
                                        @foreach(\App\Models\Tag::getTaskAvailableTags() as $tag)
                                            <label for="" class="form-check-label">
                                                <input wire:model.defer="filter_tags" type="checkbox"
                                                       value="{{$tag->id}}"
                                                       class="form-check-input form-check-inline">
                                                <span class="badge bg-info">
                                                {{$tag->name}}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column  justify-content-start mt-4 " style="overflow-y: scroll; height: 540px">
            @foreach($tasks as $task)
                <livewire:components.task-item :task="$task" :key="'task-'.$task->id"/>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ایجاد وظیفه جدید</h5>
                </div>
                <div class="modal-body">
                    <livewire:project.create-task-form :project="$project"/>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تغییر اعضای پروژه</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('project.edit.user',$project->id)}}" method="post">
                        @csrf
                        @foreach($users as $user)
                            <label for="">
                                <input type="checkbox" name="users[]"
                                       {{$project->users->contains($user) ? 'checked':''}} value="{{$user->id}}"
                                       class="form-check-input form-check-inline">
                                {{$user->name}}
                            </label>
                        @endforeach
                        <div class="d-flex m-2">

                            <button class="btn btn-outline-dark" type="submit">
                                ذخیره
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تغییر نام پروژه</h5>
                </div>
                <div class="modal-body">
                    <form action="" wire:submit.prevent="updateName">
                        <input type="text" class="form-control form-control-sm" wire:model.defer="project.name"
                               placeholder="نام پروژه"
                               value="{{$project->name}}">
                        <div class="d-flex m-2">

                            <button class="btn btn-outline-dark" data-bs-dismiss="modal" type="submit">
                                ذخیره
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


