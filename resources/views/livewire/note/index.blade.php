<div class="mt-2 mb-2">

    <div class="d-flex justify-content-start align-items-center">
        <button class="btn btn-outline-success">فیلتر</button>
    </div>

    <div class="d-flex  flex-row justify-content-center align-items-center">
        <div class="card w-50 shadow">
            <div class="card-body pb-1">
                <livewire:note.create-note-form/>
            </div>
        </div>
    </div>

    <div class="d-flex mt-5 flex-wrap flex-row  justify-content-start align-items-center">
        @foreach($desk->notes as $key=>$note)
            <livewire:components.note :note="$note"/>
        @endforeach
    </div>
</div>
