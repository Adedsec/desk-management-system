<div>
    <div class="row mt-3">
        <div class="d-flex w-100 justify-content-start align-items-start">
            <button class="btn btn-dark mx-1" data-bs-toggle="modal" data-bs-target="#createLetterModal"><i
                    class="bi bi-plus-lg"></i> ایجاد
                نامه
            </button>
            <button class="btn btn-dark mx-1 " data-bs-toggle="modal" data-bs-target="#tagModal"><i
                    class="bi bi-plus-lg"></i> افزودن
                برچسب
            </button>
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

    <div class="modal fade" id="createLetterModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg">
            <div class="modal-content ">

                <div class="modal-header text-dark">
                    ایجاد نامه
                </div>
                <div class="modal-body">
                    <form action="" wire:submit.prevent="createLetter">
                        <div class="form-floating">
                            <input type="text" id="letterTitle" wire:model.defer="letter_title"
                                   class="form-control form-control-sm"
                                   placeholder="عنوان نامه ">
                            <label for="letterTitle" style="left: auto">عنوان نامه</label>
                        </div>

                        <div class="form-group mt-3">
                            <label for="letterBody">متن نامه :</label>
                            <textarea name="" wire:model.defer="letter_body" id="letterBody" cols="" rows="3"
                                      class="form-control form-control-sm"
                                      placeholder="متن نامه را وارد کنید ..."></textarea>
                        </div>

                        <div class="">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-danger">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="d-flex justify-content-start align-items-center">
                            <button type="button" data-bs-target="#usersCollapse" data-bs-toggle="collapse"
                                    class="btn btn-outline-dark">
                                <i class="bi bi-people"></i>
                            </button>
                            <button type="button" data-bs-target="#tagsCollapse" data-bs-toggle="collapse"
                                    class="btn mx-2 btn-outline-dark">
                                <i class="bi bi-tag"></i>
                            </button>


                        </div>


                        <div class="collapse mt-3 " id="usersCollapse">
                            <p>گیرنده : </p>
                            <div class="d-flex justify-content-start align-items-baseline flex-wrap">

                                @foreach($desk->users as $user)
                                    <div class="form-group">
                                        <input type="checkbox" wire:model.defer="users" value="{{$user->id}}"
                                               id="tag{{$user->id}}"
                                               class="form-check-inline form-check-input">
                                        <label class="" for="tag{{$user->id}}">
                                            {{$user->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="collapse mt-3 " id="tagsCollapse">
                            <p>برچسب ها : </p>
                            <div class="d-flex justify-content-start align-items-baseline flex-wrap">
                                @foreach(\App\Models\Tag::getLetterAvailableTags() as $tag)
                                    <div class="form-group">
                                        <input type="checkbox" wire:model.defer="tags" value="{{$tag->id}}"
                                               id="tag{{$tag->id}}"
                                               class="form-check-inline form-check-input">
                                        <label class="" for="tag{{$tag->id}}">
                                            {{$tag->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex mt-3 justify-content-end align-items-center">
                            <button class="btn btn-outline-danger mx-1" type="button" wire:click="letterCancel"
                                    data-bs-dismiss="modal">لغو
                            </button>
                            <button class="btn btn-dark mx-1" type="submit">ایجاد
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
