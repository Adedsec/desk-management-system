@if (is_null($desk))
    <div class="mt-5">
        <div class="card bg-danger">
            <div class="card-body">
                <p class="card-title text-light">
                    لطفا ابتدا یک میزکار ایجاد کنید
                </p>
            </div>
        </div>
    </div>
@else

    <div>

        <div class="row mt-3">
            <div class="d-flex w-100 justify-content-start align-items-start">
                <button class="btn btn-dark mx-1" data-bs-target="#filterCollapse" data-bs-toggle="collapse"><i
                        class="bi bi-plus-lg"></i> فیلتر نامه ها
                </button>

                <div class="flex-grow-1 mx-2 collapse" id="filterCollapse">
                    <div class="card">
                        <div class="card-body">
                            <form action="" wire:submit.prevent="filter">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-md-4">
                                        <input type="text" id="text" wire:model.defer="filter_text"
                                               class="form-control form-control-sm"
                                               placeholder="عنوان نامه  ">
                                    </div>

                                    <button type="submit" class="btn btn-outline-dark">اعمال فیلتر</button>
                                </div>

                                <div class=" mt-2">
                                    <p>برچسب :</p>
                                    <div class="d-flex flex-wrap justify-content-start align-items-center">
                                        @foreach(\App\Models\Tag::getLetterAvailableTags() as $tag)
                                            <label for="" class="form-check-label mx-1">
                                                <input wire:model.defer="filter_tags" name="tags" type="checkbox"
                                                       value="{{$tag->id}}"
                                                       class="form-check-inline">
                                                {{$tag->name}}
                                            </label>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="d-flex px-5 justify-content-evenly align-items-center mt-3">

                                    <div class="col-md-3 mx-2">
                                        <div class="d-flex  justify-content-center align-items-center">
                                            <label class="col-md-3 text-right" for="start_date">
                                                از تاریخ :
                                            </label>
                                            <input type="date" wire:model.defer="filter_start" id="start_date"
                                                   class="form-control-sm form-control col-md-7">
                                        </div>
                                    </div>

                                    <div class="col-md-3 mx-2">
                                        <div class="d-flex  justify-content-center align-items-center">
                                            <label class="col-md-3 text-right" for="end_date">
                                                تا تاریخ :
                                            </label>
                                            <input type="date" wire:model.defer="filter_end" id="end_date"
                                                   class="form-control-sm form-control col-md-7">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <ul class="d-flex flex-column justify-content-start align-items-center mb-5 w-100 px-5 list-group">
                @foreach($letters as $letter)
                    <livewire:components.letter-item :letter="$letter" :key="$letter->id"/>
                @endforeach
            </ul>
        </div>
    </div>
@endif
