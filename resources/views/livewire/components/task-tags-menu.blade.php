<div class="" style="margin-right: auto">
    <div class="">
        <button class="btn" data-bs-toggle="dropdown">برچسب ها</button>
        <ul class="dropdown-menu mx-2 text-right" aria-labelledby="navbarDropdownMenuLink">


            @foreach(\App\Models\Tag::getTaskAvailableTags() as $tag)
                <li class="dropdown-item">{{$tag->name}}</li>
            @endforeach
            <li>
                <button class="dropdown-item btn" data-bs-target="#tagModal" data-bs-toggle="modal" href="#"><i
                        class="bi bi-bookmark-plus"></i> افزودن برچسب
                </button>
            </li>
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




