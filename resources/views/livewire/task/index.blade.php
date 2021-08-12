<div class=" mt-4 vh-84">

    <div class="d-flex justify-content-start align-items-start">
        <button class="btn btn-outline-primary" data-bs-target="#filterCollapse" data-bs-toggle="collapse">
            فیلتر
        </button>
        <div class="flex-grow-1 mx-4 mt-2">
            <div class="collapse" id="filterCollapse">
                <div class="card" style="height: 300px">
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column  justify-content-start mt-4 ">
        @foreach($tasks as $task)
            <livewire:components.task-item :task="$task"/>
        @endforeach
    </div>
</div>
