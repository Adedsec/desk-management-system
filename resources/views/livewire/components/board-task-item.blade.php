<a type="button" class="text-decoration-none" data-bs-target="#viewTaskModal" data-bs-toggle="modal">
    <div class="card shadow my-1">
        <div class="card-body py-2">
            <div class="d-flex w-100 flex-row justify-content-start ">
                <input type="checkbox" class="form-check-input">
                <strong class="card-title mx-1 text-dark  small">{{$task->title}}</strong>
            </div>
            {{--        daedline--}}
            @if (!is_null($task->deadline))
                <div class="w-100">
                    <span class="badge bg-info p-2 rounded-1">مهلت انجام : {{$task->persianDeadline()}}</span>
                </div>
            @endif
            {{--        tags--}}
            <div class="d-flex mt-2 flex-wrap align-items-center justify-content-start">
                @foreach($task->tags as $tag)
                    <span class="badge bg-secondary p-2 small  rounded-1" style="margin-left: 4px">{{$tag->name}}</span>
                @endforeach

            </div>

            @if ($task->progress != 0)
                <div class="progress mt-3 mb-1" style="height: 3px">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$task->progress}}%"
                         aria-valuenow="{{$task->progress}}"
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            @endif
        </div>
    </div>
</a>

<div class="modal fade" id="viewTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>




