<form action="" wire:submit.prevent="submit" enctype="multipart/form-data">

    <div class="form-group">
        <label for="name" class="form-label">
            نام :
        </label>
        <input id="name" name="name" wire:model.defer="user.name" type="text" class="form-control form-control-sm"
               placeholder="نام"
               value="{{$user->name}}">
    </div>

    <div class="form-group mt-2">
        <label for="email" class="form-label">
            ایمیل :
        </label>
        <input id="email" name="email" wire:model.defer="email" type="email" class="form-control form-control-sm"
               placeholder="ایمیل"
               value="{{$user->email}}">
    </div>

    <div class="form-group mt-2">
        <label for="phone_number" class="form-label">
            شماره تلفن :
        </label>
        <input id="phone_number" name="phone_number" wire:model.defer="user.phone_number" type="tel"
               class="form-control form-control-sm"
               placeholder="شماره تلفن"
               value="{{$user->phone_number}}">
    </div>

    <div class="row mt-3 d-flex justify-content-between align-items-center">

        <div class="col-md-6">
            <label for="">
                <input type="checkbox" id="deleteAvatar" wire:model.defer="deleteAvatar" onclick="checkAvatar(this)"
                       name="deleteAvatar"
                       class="form-check-input form-check-inline">
                حذف تصویر پروفایل
            </label>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="avatar" class="form-label">
                    تصویر :
                </label>
                <input id="avatar" name="avatar" type="file" wire:model.defer="avatar"
                       class="form-control form-control-sm"
                       placeholder="نام"
                       value="{{$user->name}}">
            </div>
        </div>
    </div>

    @foreach($errors->all() as $error)
        <li class="text-danger small">
            {{$error}}
        </li>
    @endforeach
    <div class="d-flex m-2">
        <button class="btn btn-outline-dark" type="submit">
            ذخیره
        </button>
    </div>
</form>
