<div class="card  shadow mx-1 my-2 " style="max-width: 25%; min-width: 10%">
    <div class="card-body">
        <img src="{{$note->image}}" alt="" class="card-img-top pb-2">
        <strong class="card-title ">
            {{$note->title}}
        </strong>
        <p class="card-text mt-2">
            {{$note->body}}
        </p>

        <div class="d-flex flex-wrap justify-content-start align-items-center">
            @foreach($note->tags as $tag)
                <span class="badge p-1 bg-secondary" style="margin: 1px">تگ یک</span>
            @endforeach
        </div>

        <div class="d-flex justify-content-between mt-4 align-items-center">
            <div>
                <a type="button" data-bs-target="#cheklistModal{{$note->id}}" data-bs-toggle="modal"
                   class="mx-1 text-secondary">
                    <i class="bi bi-card-checklist" title="مشاهده چک لیست" style="font-size: 20px"></i>
                </a>
                <a type="button" data-bs-toggle="modal" data-bs-target="#editModal{{$note->id}}" title="ویرایش"
                   class="mx-1 text-secondary">
                    <i class="bi bi-pencil-fill" style="font-size: 16px"></i>
                </a>
            </div>
            <div>
                <a type="button" data-bs-toggle="tooltip" wire:click="delete" data-bs-placement="bottom" title="حذف"
                   class="mx-1 text-secondary">
                    <i class="bi bi-x-lg" style="font-size: 16px"></i>
                </a>
            </div>

        </div>
    </div>


    <div class="modal fade" id="cheklistModal{{$note->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <livewire:components.check-list-show-notes :note="$note"/>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal{{$note->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <livewire:components.edit-note-form :note="$note"/>
                </div>
            </div>
        </div>
    </div>
</div>
