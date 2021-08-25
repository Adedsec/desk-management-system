<form action="" wire:submit.prevent="edit">
    <div class="form-group">


        <input type="text" name="title" wire:model.lazy="title" value="{{$title}}" class="form-control"
               placeholder="نام لیست ...">
        @error('title')
        <li class="small text-danger">{{$message}}</li>
        @enderror
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <button type="button" data-bs-dismiss="modal" class="btn mt-4 mx-1 btn-outline-danger">لغو</button>
        <button type="submit" class="btn mt-4 btn-outline-success">بروزرسانی</button>

    </div>
</form>
