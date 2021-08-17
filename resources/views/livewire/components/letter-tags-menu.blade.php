<div class="" style="margin-right: auto">
    <div class="">
        <button class="btn btn-dark m-1 " data-bs-toggle="dropdown" style="margin-right: auto">برچسب ها</button>
        <ul class="dropdown-menu text-right">
            @foreach(\App\Models\Tag::getLetterAvailableTags() as $tag)
                <li class=""><a href="" class="dropdown-item disabled">{{$tag->name}}</a></li>
            @endforeach
            <li><a class="dropdown-item" href="#tagModal" data-bs-toggle="modal">افزودن برچسب</a></li>
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
                    <form action="" wire:submit.prevent="store">
                        <input type="text" wire:model.lazy="name" value="name" class="form-control form-control-sm"
                               placeholder="نام برچسب">
                        <button type="submit" class="btn btn-dark mt-3" data-bs-dismiss="modal">ذخیره</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>




