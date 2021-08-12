<div class="card  shadow mx-1 my-2 " style="max-width: 20%; min-width: 10%">
    <div class="card-body">
        <strong class="card-title">
            {{$note->title}}
        </strong>
        <p class="card-text mt-2">
            {{$note->body}}
        </p>

        <div class="d-flex justify-content-between mt-4 align-items-center">
            <div>
                <a type="button" class="mx-1 text-secondary">
                    <i class="bi bi-palette-fill" title="تغییر رنگ" style="font-size: 16px"></i>
                </a>
                <a type="button" class="text-secondary">
                    <i class="bi bi-tag-fill" title="برچسب ها" style="font-size: 16px"></i>
                </a>
                <a type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ویرایش"
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
</div>
