<li class="list-group-item w-100 mx-4 ">
    <a href="{{route('letters.show',$letter->id)}}" class="text-dark text-decoration-none d-block">
        <div class="d-flex w-100 flex-row justify-content-between align-items-center">
            <div class="d-flex w-50 flex-row justify-content-start align-items-center">
                <img src="{{$letter->user->getAvatar()}}" alt="" width="50px" height="50px"
                     class="rounded-circle">
                <p class="my-1 mx-2">{{$letter->user->name}}</p>
                <p class="my-1 mx-5">{{$letter->title}}</p>
                <p class="my-1 mx-1">{{$letter->summary()}}</p>
            </div>

            <div class="d-flex flex-row justify-content-end align-items-center">
                <div class="d-flex align-items-end flex-wrap justify-content-center">
                    @foreach($letter->tags as $tag)
                        <span class="badge mx-1 p-2 bg-warning text-dark">{{$tag->name}}</span>
                    @endforeach
                </div>
                <p class=" my-1 mx-2">{{$letter->persianCreated()}}</p>
            </div>
        </div>
    </a>

</li>
