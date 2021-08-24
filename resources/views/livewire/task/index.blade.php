@if (is_null($desk))
    <div class="mt-5">
        <div class="card bg-danger">
            <div class="card-body">
                <p class="card-title text-light">
                    لطفا ابتدا یک میزکار ایجاد کنید
                </p>
            </div>
        </div>
    </div>
@else
    <div class=" mt-4 vh-84">

        <div class="d-flex justify-content-start align-items-start">
            @if (empty(\Illuminate\Support\Facades\Auth::user()->desk->projects))

                @can('manage_project')
                    <a href="{{route('projects.create')}}" class="btn btn-outline-danger mx-3">
                        <i class="bi bi-plus-lg"></i>
                        ساخت پروژه
                    </a>
                @endcan
            @else
                @can('manage_tasks')
                    <button class="btn btn-outline-dark mx-3" data-bs-target="#createTaskModal" data-bs-toggle="modal">
                        <i class="bi bi-plus-lg"></i>
                        ایجاد وظیفه
                    </button>
                @endcan
            @endif
            <button class="btn btn-outline-primary" data-bs-target="#filterCollapse" data-bs-toggle="collapse">
                فیلتر
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

                                    <div class="col-md-3">
                                        <select name="project" wire:model.defer="filter_project" id=""
                                                class="form-select form-select-sm">
                                            <option class="" value="0">انتخاب پروژه</option>
                                            @foreach($desk->projects as $project)
                                                <option class="" value="{{$project->id}}">{{$project->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 form-check form-switch">
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
                                                {{$tag->name}}
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
        <div class="d-flex flex-column  justify-content-start mt-4 ">
            @if (empty($tasks))
                <p class="card-title">وظیفه ای یافت نشد !!</p>
            @else
                @foreach($tasks as $task)
                    <livewire:components.task-item :task="$task" :key="'task-'.$task->id"/>
                @endforeach
            @endif

        </div>


        <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ایجاد وظیفه جدید</h5>
                    </div>
                    <div class="modal-body">
                        <livewire:task.create-task-form/>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endif
