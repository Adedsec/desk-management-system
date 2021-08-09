<div class="mt-2">

    @if (!is_null($checklist))
        <ul class="list-group my-1 px-0">
            @foreach($checklist as $key=>$item)
                <li class="list-group-item">
                    <div class="d-flex flex-row list-group justify-content-between align-items-center  w-100">
                        <div>
                            <input class="form-check-input" checked disabled type="checkbox"
                                   id="checkItem-{{$key}}"
                                   value="{{$item}}">
                            <label for="checkItem-{{$key}}" class="form-check-label">{{$item}}</label>
                        </div>

                        <div>
                            <button type="button" wire:click="deleteItem('{{$key}}')"
                                    class="btn p-0 m-0 bg-transparent">
                                <i class="text-danger bi bi-x"></i>
                            </button>
                        </div>

                    </div>
                </li>


            @endforeach
        </ul>

    @endif

    <input type="text" value="{{$item}}" class="form-control" wire:keydown.enter="addItem" wire:model="item"
           placeholder="افزودن مورد به چک لیست">


    <button class="btn btn-outline-success" type="button" wire:click="save">ذخیره</button>
</div>
