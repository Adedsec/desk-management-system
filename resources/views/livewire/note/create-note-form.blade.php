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

    <div class="collapse mt-3" id="imageCollapse">
        <input class="form-control" wire:model.lazy="image" type="file">
    </div>
    <div class="collapse mt-3" id="checklistCollapse">
        <livewire:components.check-list/>
    </div>

    <div class="w-100 mt-2 mb-0 d-flex justify-content-between align-items-center ">
        <div class="d-flex justify-content-start align-items-center">
            <a type="button" data-bs-target="#checklistCollapse" data-bs-toggle="collapse" class="text-dark"><i
                    class="bi bi-card-checklist"
                    style="font-size: 30px"></i></a>
            <a type="button" data-bs-target="#imageCollapse" data-bs-toggle="collapse" class="mx-3 text-dark"><i
                    class="bi bi-image" style="font-size: 26px"></i></a>
        </div>
        <div class="d-flex  justify-content-center flex-grow-1 align-items-center">
            <input type="radio" value="white" wire:model.lazy="color" class="btn-check" name="color" id="white"
                   autocomplete="off">
            <label class="btn btn-outline-primary mx-1 border-2 color-label rounded-circle"
                   for="white"></label>

            <input type="radio" value="green" wire:model.lazy="color" class="btn-check" name="color" id="green"
                   autocomplete="off">
            <label class="btn btn-outline-success mx-1 border-2 color-label rounded-circle"
                   for="green"></label>

            <input type="radio" value="red" wire:model.lazy="color" class="btn-check" name="color" id="red"
                   autocomplete="off">
            <label class="btn btn-outline-danger mx-1 border-2 color-label rounded-circle"
                   for="red"></label>
        </div>


        <div class="d-flex justify-content-end align-items-center">
            <button class="btn btn-dark text-light" type="submit">ایجاد</button>
        </div>
    </div>

</form>
