<div class=" mt-4 vh-84">

    <div class="d-flex justify-content-start align-items-start">
        @if (empty(\Illuminate\Support\Facades\Auth::user()->desk->projects))
            <a href="{{route('projects.create')}}" class="btn btn-outline-danger mx-3">
                <i class="bi bi-plus-lg"></i>
                ساخت پروژه
            </a>
        @else
            <button class="btn btn-outline-dark mx-3" data-bs-target="#createTaskModal" data-bs-toggle="modal">
                <i class="bi bi-plus-lg"></i>
                ایجاد وظیفه
            </button>
        @endif
        <button class="btn btn-outline-primary" data-bs-target="#filterCollapse" data-bs-toggle="collapse">
            فیلتر
        </button>
        <div class="flex-grow-1 mx-4 mt-2">
            <div class="collapse" id="filterCollapse">
                <div class="card">
                    <div class="card-body">
                        <form action="">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column  justify-content-start mt-4 ">
        @foreach($tasks as $task)
            <livewire:components.task-item :task="$task"/>
        @endforeach
    </div>


    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
