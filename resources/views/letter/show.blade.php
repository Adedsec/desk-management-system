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
                @if ($letter->archived==true)
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
    </div>
@endsection
