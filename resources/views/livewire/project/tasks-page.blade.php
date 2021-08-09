<div class="row vh-84 pb-3 mt-4">
    <div class="col-md-3">
        <div class="card h-100"></div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="d-flex justify-content-start align-items-start">
                <button class="btn btn-outline-primary" data-bs-target="#filterCollapse" data-bs-toggle="collapse">فیلتر
                </button>
                <div class="flex-grow-1">
                    <div class="collapse" id="filterCollapse">
                        filter collapse
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @foreach($project->tasks as $task)
                <livewire:components.task-item :task="$task"/>
            @endforeach
        </div>
    </div>
</div>


