@if (is_null($projects))
    <div class="mt-4">
        <div class="card bg-danger">
            <div class="card-body">
                <p class="card-title text-light">
                    ابتدا یک میز کار ایجاد کنید !!!!
                </p>
            </div>
        </div>
    </div>
@else
    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-start align-items-baseline">
                <h2>پروژه ها</h2> <a href="{{route('projects.create')}}" class="btn btn-primary text-light mx-4">افزودن
                    پروژه جدید</a>
            </div>
            <div class="w-25">
                <input class="form-control" placeholder="فیلتر پروژه ها ..." name="filter" wire:model="filter"
                       type="text">
            </div>
        </div>
        <div class="row h-25 mt-5 mx-1">
            @foreach($projects as $project)
                <div class="col-md-2 p-2">
                    <a class="text-decoration-none text-dark" href="{{route('projects.show',$project->id)}}">
                        <div class="card project-item rounded-5 h-100  shadow " style="border-radius:10px">

                            <div
                                class="card-body rounded-5 d-flex flex-column justify-content-start align-items-center">
                                <div class="mb-3">
                                    <img src="{{$project->getAvatar()}}" width="100px" height="100px"
                                         class="rounded-circle"
                                         alt="">
                                </div>
                                <h5 class="text-center m-0">{{$project->name}}</h5>

                                <div>
                                    <div class="row mt-3">
                                        <p class="m-0">وضعیت کلی پروژه :</p>
                                        <div class="progress  p-0" style="height: 15px">
                                            <div class="progress-bar small" role="progressbar"
                                                 style="width: {{$project->generalProgress()}}%;"
                                                 aria-valuenow="{{$project->generalProgress()}}"
                                                 aria-valuemin="0" aria-valuemax="100">{{$project->generalProgress()}}%
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row  mt-3">
                                        <p class="m-0">وظایف من :</p>
                                        <div class="progress p-0" style="height: 15px">
                                            <div class="progress-bar small" role="progressbar"
                                                 style="width: {{$project->userProgress()}}%;"
                                                 aria-valuenow="{{$project->userProgress()}}"
                                                 aria-valuemin="0" aria-valuemax="100">{{$project->userProgress()}}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white  border-1"
                                 style="border-bottom-left-radius: 10px;border-bottom-right-radius: 10px">
                                <div class="d-flex justify-content-between">
                                    <div><span class="badge bg-secondary text-light"
                                               style="font-size: 12px">{{$project->userTasksCount()-$project->userCompletedTasksCount()}}</span>
                                    </div>
                                    <div class="small">
                                        وظایف انجام شده : {{$project->completedTasksCount()}}
                                        از {{$project->allTasksCount()}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach

            <div class="col-md-2 p-2">
                <a class="text-decoration-none text-dark" href="{{route('projects.create')}}">
                    <div class="card  h-100 shadow-sm " style="border-style: dashed">
                        <div
                            class="card-body h-100 rounded-3 d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-plus-circle-fill" style="font-size: 40px"></i>
                            ساخت پروژه جدید
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endif


