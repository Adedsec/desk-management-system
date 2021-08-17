<div class="mt-2 mb-2">

    <div class="d-flex justify-content-start align-items-start">
        <button class="btn btn-outline-dark" data-bs-target="#tagModal" data-bs-toggle="modal"><i
                class="bi bi-plus-lg"></i> افزودن برجسب
        </button>
        <button class="btn btn-outline-success mx-2" data-bs-target="#filterCollapse" data-bs-toggle="collapse">فیلتر
        </button>

        <div class=" w-50 card collapse" id="filterCollapse">
            <div class="card-body">
                <form action="" wire:submit.prevent="filter">
                    <div class="row px-3">
                        <input type="text" wire:model.defer="filter_text" class="form-control form-control-sm"
                               placeholder="عنوان یادداشت">
                    </div>
                    <div class="row mt-2">
                        <p>برچسب :</p>
                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                            @foreach(\App\Models\Tag::getNoteAvailableTags() as $tag)
                                <label for="" class="form-check-label mx-1">
                                    <input wire:model.defer="filter_tags" name="tags" type="checkbox"
                                           value="{{$tag->id}}"
                                           class="form-check-inline">
                                    {{$tag->name}}
                                </label>
                            @endforeach
                        </div>
                        <div class="d-flex mt-2 justify-content-start align-items-center">

                            <button type="submit" class="btn btn-outline-dark">اعمال فیلتر</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex mt-2  flex-row justify-content-center align-items-center">
        <div class="card w-50 shadow">
            <div class="card-body pb-1">
                <livewire:note.create-note-form/>
            </div>
        </div>
    </div>

    <div class="d-flex mt-5 flex-wrap flex-row  justify-content-center align-items-start">
        @foreach($notes as $key=>$note)
            <livewire:components.note :note="$note"/>
        @endforeach
    </div>

    <div class="modal fade" id="tagModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content ">

                <div class="modal-header text-dark">
                    افزودن برچسب جدید
                </div>
                <div class="modal-body">
                    <form action="" wire:submit.prevent="createTag">
                        <input type="text" value="" wire:model.defer="tag_name" class="form-control form-control-sm"
                               placeholder="نام برچسب">
                        <button type="submit" class="btn btn-dark mt-3" data-bs-dismiss="modal">ذخیره</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
