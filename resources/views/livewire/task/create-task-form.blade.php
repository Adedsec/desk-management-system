<form onkeypress="return event.keyCode != 13;" wire:submit.prevent="submit">
    <div class="form-floating text-right">
        <input type="text" id="title" wire:model.defer="title" name="title" placeholder="عنوان وظیفه"
               class="form-control text-right right">
        <label class="text-right right" style="left: auto" for="title">عنوان وظیفه</label>
    </div>


    <div class="d-flex mt-2 w-50">
        <select name="project" id="project" wire:model.defer="project" title="انتخاب پروژه"
                class="form-select form-control">
            @foreach($desk->projects as $project)
                <option value="{{$project->id}}">{{$project->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="d-flex mt-2 justify-content-start align-items-center">
        <button type="button" class="btn btn-outline-success mx-1"
                data-bs-target="#descriptionCollapse"
                data-bs-toggle="collapse">
            افزودن توضیحات
        </button>
        <button type="button" class="btn btn-outline-success mx-1"
                data-bs-target="#chekListCollapse"
                data-bs-toggle="collapse">
            <i class="bi bi-card-checklist"></i>
        </button>

        <button type="button" class="btn btn-outline-success mx-1"
                data-bs-target="#deadlineCollapse"
                data-bs-toggle="collapse">
            <i class="bi bi-clock-fill"></i>
        </button>
        <button type="button" class="btn btn-outline-success mx-1"
                data-bs-target="#usersCollapse"
                data-bs-toggle="collapse">
            <i class="bi bi-people-fill"></i>
        </button>

        <button type="button" class="btn btn-outline-success mx-1"
                data-bs-target="#attachCollapse"
                data-bs-toggle="collapse">
            <i class="bi bi-paperclip"></i>
        </button>
        <button type="button" class="btn btn-outline-success mx-1"
                data-bs-target="#tagsCollapse"
                data-bs-toggle="collapse">
            <i class="bi bi-tag-fill"></i>
        </button>

    </div>


    <div class="collapse" id="descriptionCollapse">
        <div class="form-group text-right mt-2">
            <label class="text-right" style="left: auto" for="description">توضیحات : </label>
            <textarea name="description" rows="3" wire:model.defer="description" id="description"
                      placeholder="افزودن توضیحات "
                      class="form-control text-right">
        </textarea>

        </div>
    </div>

    <div class="collapse" id="chekListCollapse">
        <livewire:components.check-list/>
    </div>

    <div class="collapse" id="deadlineCollapse">
        <div class="form-group text-right mt-2">
            <label class="text-right" style="left: auto" for="deadline">مهلت انجام : </label>
            <input type="datetime-local" wire:model.defer="deadline" class="form-control">
        </div>
    </div>

    <div class="collapse" id="attachCollapse">
        <div class="form-group text-right mt-2">
            <label class="text-right" style="left: auto" for="attachment">پیوست فایل </label>
            <input type="file" multiple wire:model.defer="attachment" id="attachment" class="form-control">
        </div>
    </div>


    <div class="collapse" id="usersCollapse">
        <div class="form-group text-right mt-2">
            <label class="text-right" style="left: auto" for="description">مسئول انجام :</label>
            <div class="">
                <ul class="d-flex px-0 flex-row">

                    @foreach($desk->users as $user)
                        <li class="list-group-item border-0">
                            <input id="#user{{$user->id}}" type="checkbox" wire:model.defer="users"
                                   value="{{$user->id}}"
                                   class="form-check-input form-check-inline">
                            <label for="user{{$user->id}}">{{$user->name}}</label>
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="collapse" id="tagsCollapse">
        <div class="form-group text-right mt-2">
            <label class="text-right" style="left: auto" for="description">افزودن برچسب</label>
            <div class="">
                <ul class="d-flex flex-wrap px-0 flex-row">

                    @foreach(\App\Models\Tag::getTaskAvailableTags() as $tag)
                        <li class="list-group-item border-0">
                            <input id="#tag{{$tag->id}}" type="checkbox" wire:model.defer="tags"
                                   value="{{$tag->id}}"
                                   class="form-check-input form-check-inline">
                            <label for="#tag{{$tag->id}}">{{$tag->name}}</label>
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    </div>


    @foreach($errors->all() as $error)
        <li class="small text-danger">{{$error}}</li>
    @endforeach

    <div class="d-flex flex-row justify-content-end align-items-center">
        <button class="btn btn-outline-success" data-bs-dismiss="modal" wire:keydown.enter.prevent=""
                type="submit">ذخیره
        </button>
    </div>

</form>
