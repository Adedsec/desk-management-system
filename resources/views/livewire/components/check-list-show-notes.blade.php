<div class="mt-2">
    @if (!is_null($checklist))
        <ul class="list-group my-1 px-0">

            @foreach($checklist->items as $item)
                <li class="list-group-item">
                    <div class="d-flex flex-row list-group justify-content-between align-items-center  w-100">
                        <div>
                            <button class="rounded-0 border-1 btn bg-transparent" type="button"
                                    wire:click="toggleChecked({{$item->id}})"
                                    id="checkItem-{{$item->id}}"
                                    value="">
                                @if ($item->checked)
                                    <i class="bi bi-check"></i>
                                @else
                                    <i class="bi bi-square"></i>
                                @endif
                            </button>
                            <label for="checkItem-{{$item->id}}"
                                   class="form-check-label {{$item->checked ? 'text-muted text-decoration-line-through' :''}}">{{$item->content}}</label>
                        </div>

                        <div>
                            <button type="button" wire:click="deleteItem('{{$item->id}}')"
                                    class="btn p-0 m-0 bg-transparent">
                                <i class="text-danger bi bi-x"></i>
                            </button>
                        </div>

                    </div>
                </li>


            @endforeach
        </ul>

    @endif

    <input type="text" value="" class="form-control mb-2" wire:keydown.enter="addItem" wire:model="item"
           placeholder="افزودن مورد به چک لیست">

</div>

