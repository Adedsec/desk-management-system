<div class="w-100 shadow-sm card py-2 my-1 flex-row  d-flex justify-content-between align-items-center">

    <div class="d-flex  flex-row align-items-center justify-content-start" style="width: 30%">
        <div class="mx-2">
            <input type="checkbox" class="form-check-input form-check-inline" style="width: 20px; height: 20px">
        </div>

        @if ($task->progress !=0)
            <div class="progress mx-3" style="width: 20%">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{$task->progress}}%;"
                     aria-valuenow="25"
                     aria-valuemin="0"
                     aria-valuemax="100">{{$task->progress}}
                </div>
            </div>
        @endif


        <div class="mx-1">
            {{$task->title}}
        </div>
    </div>
    <div class="d-flex  flex-row align-items-center justify-content-start">

        @if (is_null($task->check_list_id))
            <i class="bi bi-check-all text-success p-1"></i>
        @endif

        <div class="mx-2">
            <span class="badge bg-info p-2">تگ یک</span>
            <span class="badge bg-info p-2">تگ یک</span>
            <span class="badge bg-info p-2">تگ یک</span>
        </div>


        <div class="small mx-2">
            @foreach($task->users as $user)
                {{$user->name}}
            @endforeach
        </div>
    </div>


</div>



