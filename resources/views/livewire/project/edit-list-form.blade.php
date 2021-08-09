<form action="" wire:submit.prevent="store">
    <div class="form-group">


        <input type="text" name="title" wire:model.lazy="title" value="{{$title}}" class="form-control"
               placeholder="نام لیست ...">
        @error('title')
        <li class="small text-danger">{{$message}}</li>
        @enderror
        <div class="form-group mt-4">

            <div class="text-dark mb-3">
                رنگ :
            </div>

            <input type="radio" value="white" wire:model.lazy="color" class="btn-check" name="color" id="white"
                   autocomplete="off">
            <label class="btn btn-outline-primary mx-1 border-3 color-label rounded-circle"
                   for="white"></label>

            <input type="radio" value="green" wire:model.lazy="color" class="btn-check" name="color" id="green"
                   autocomplete="off">
            <label class="btn btn-outline-success mx-1 border-3 color-label rounded-circle"
                   for="green"></label>

            <input type="radio" value="red" wire:model.lazy="color" class="btn-check" name="color" id="red"
                   autocomplete="off">
            <label class="btn btn-outline-danger mx-1 border-3 color-label rounded-circle"
                   for="red"></label>


            @error('color')
            <li class="small text-danger">{{$message}}</li>
            @enderror


            <input type="radio" value="yellow" wire:model.lazy="color" class="btn-check" name="color" id="yellow"
                   autocomplete="off">
            <label class="btn btn-outline-warning mx-1 border-3 color-label rounded-circle"
                   for="yellow"></label>
        </div>
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <button type="button" data-bs-dismiss="modal" class="btn mt-4 mx-1 btn-outline-danger">لغو</button>
        <button type="submit" class="btn mt-4 btn-outline-success">بروزرسانی</button>

    </div>
</form>
