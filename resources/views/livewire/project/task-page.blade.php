<div class="row mt-4 pb-5 vh-84">
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <p class="card-title">
                    وضعیت کلی :
                </p>
                <div class="progress mt-3" style="height: 5px">
                    <div class="progress-bar bg-success" role="progressbar"
                         title="انجام شده : {{$project->generalProgress()}}%"
                         style="width: {{$project->generalProgress()}}%" aria-valuenow="{{$project->generalProgress()}}"
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
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <img src="{{$user->getAvatar()}}" alt="" width="40px" height="40px">
                            <p class="small">{{$user->name}}</p>
                        </div>
                    @endforeach

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
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column  justify-content-start mt-4 " style="overflow-y: scroll; height: 540px">
            @foreach($project->tasks as $task)
                <livewire:components.task-item :task="$task"/>
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
</div>


