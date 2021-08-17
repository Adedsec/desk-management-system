<form onkeypress="return event.keyCode != 13;" action="" wire:submit.prevent="store">
    <input type="text" wire:model="title"
           class="form-control form-control-sm border-0 border-bottom focus-none input-focus " name="title"
           placeholder="عنوان یادداشت">

    <div class="form-group mt-4">
        <textarea id="body" wire:model="body" type="text" rows='4' class="form-control form-control-sm   " name="body"
                  placeholder=" متن یادداشت"></textarea>
    </div>

    <div class="m-3">
        @foreach($errors->all() as $error)
            <li class="small text-danger">{{$error}}</li>
        @endforeach
    </div>

    <div class="w-100 mt-2 mb-0 d-flex justify-content-end align-items-center ">

        <div class="d-flex justify-content-end align-items-center">
            <button class="btn btn-dark text-light" type="submit">بروزرسانی</button>
        </div>
    </div>

</form>

