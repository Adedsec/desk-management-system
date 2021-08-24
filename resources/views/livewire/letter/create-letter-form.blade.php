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

                @if ($user->id != \Illuminate\Support\Facades\Auth::user()->id)
                    <div class="form-group">
                        <input type="checkbox" wire:model.defer="users" value="{{$user->id}}"
                               id="tag{{$user->id}}"
                               class="form-check-inline form-check-input">
                        <label class="" for="tag{{$user->id}}">
                            {{$user->name}}
                        </label>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="collapse mt-3 " id="tagsCollapse">
        <p>برچسب ها : </p>
        <div class="d-flex justify-content-start align-items-baseline flex-wrap">
            @foreach($available_tags as $tag)
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
                data-bs-dismiss="modal">بازگشت
        </button>
        <button class="btn btn-dark mx-1" type="submit">ایجاد
        </button>
    </div>
</form>
