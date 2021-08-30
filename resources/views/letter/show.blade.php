@extends('layouts.app')

@section('content')
    <div class=" shadow p-3 d-flex justify-content-between align-items-center"
         style="margin-right: -11px ;margin-left: -11px">
        <div class="d-flex justify-content-start align-items-baseline">
            <a href="{{\Illuminate\Support\Facades\URL::previous()}}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-right"></i> بازگشت به صفحه نامه ها
            </a>

            <p class="card-title mx-4">
                عنوان نامه :
                {{$letter->title}}
            </p>

        </div>
        <div class="d-flex justify-content-end align-items-center">

            <div class="mx-3">
                @foreach($letter->tags as $tag)
                    <span class="badge p-2 bg-warning text-dark">{{$tag->name}}</span>
                @endforeach
            </div>

            <a href="{{route('letters.archive.add',$letter->id)}}" class="btn btn-outline-dark align-baseline">
                @if ($letter->isArchived(\Illuminate\Support\Facades\Auth::user()))
                    <i class="bi bi-archive pt-1"></i>خارج کردن از آرشیو
                @else
                    <i class="bi bi-archive pt-1"></i> آرشیو کردن نامه
                @endif

            </a>
        </div>
    </div>

    <div class="mt-5 border-bottom">
        <div class="d-flex justify-content-start align-items-start">
            <img src="{{$letter->user->getAvatar()}}" alt=" " class="rounded-circle"
                 style="margin-left: 10px;margin-right: 50px" width="50px" height="50px">
            <div class="mx-3">
                <p>فرستنده
                    : {{$letter->user->name== \Illuminate\Support\Facades\Auth::user()->name ? 'من': $letter->user->name}}</p>
                @if (\Illuminate\Support\Facades\Auth::user()->id===$letter->user->id)
                    <p>
                        گیرنده :
                        @foreach($letter->users as $user)
                            {{$user->name}} ،
                        @endforeach
                    </p>
                @else
                    گیرنده : من
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">

                <p class="card-text m-5">
                    {{$letter->body}}
                </p>
            </div>
        </div>

        <div class="d-flex flex-column w-100  my-2 px-5 justify-content-start align-items-start">

            @foreach ($paraphs as $paraph)
                <div class="card  bg-transparent shadow-lg m-2" style="min-width: 50%">
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <div class="d-flex justify-content-start align-items-center">
                                <img src="{{$paraph->sender->getAvatar()}}"
                                     class="rounded-circle border-4 border-dark shadow" width="50px"
                                     height="50px"
                                     alt="{{$paraph->sender->name}}"
                                     title="{{$paraph->sender->name}}">

                                <p class="card-text mx-2">
                                    {{$paraph->body}}
                                </p>
                            </div>


                            <div class="d-flex mt-2 w-100 justify-content-end align-items-start">
                                <p class="card-text">
                                    به :
                                    @foreach ($paraph->users as $user)
                                        {{\Illuminate\Support\Facades\Auth::user()->id == $user->id ? 'من' : $user->name}}
                                        ,
                                    @endforeach
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            @endforeach

        </div>

        <div class="d-flex mb-2 px-5 py-2 justify-content-start align-items-center w-100">
            <button class="btn btn-outline-dark" data-bs-target="#paraphModal" data-bs-toggle="modal">
                <i class="bi bi-arrow-90deg-left"></i>
                ارجاع/پاسخ دادن
            </button>
        </div>

        <div class="modal fade" id="paraphModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ارجاع/پاسخ دادن نامه </h5>
                    </div>
                    <div class="modal-body">
                        <form id="parahpForm" action="{{route('letters.paraph',$letter->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="body" class="">متن : </label>
                                <textarea name="body" id="body" class="form-control"></textarea>
                            </div>

                            <div class="form-group mt-2">
                                <p>به : </p>
                                <div class="d-flex justify-content-start align-items-center">
                                    @foreach($letter->desk->users as $user)
                                        <label for="" class="form-check-label">
                                            <input type="checkbox" name="users[]" value="{{$user->id}}"
                                                   class="form-check-input form-check-inline">
                                            {{$user->name}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                        <button type="submit" form="parahpForm" class="btn btn-outline-success">ارسال</button>
                    </div>
                </div>
            </div>
        </div>

    </div>




@endsection
