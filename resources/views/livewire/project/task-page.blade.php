<div class="row mt-4 vh-84">
    <div class="col-md-3">
        <div class="card h-100">

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


