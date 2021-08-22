@extends('layouts.app')

@section('content')
    <div class="mt-5 w-auto ">
        <div class="row justify-content-center align-items-center">
            <div class="card w-50 shadow">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-baseline flex-row">
                        <div class="">
                            افزودن پروژه به میزکار
                        </div>
                        <div
                            class="badge bg-success  text-light left">{{$activeDesk->name}}
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    <p class="card-title mb-2 bg-white">
                        در صورت استفاده از پروژه، همکاران شما می‌توانند به صورت چابک و سریع با یکدیگر ارتباط داشته
                        باشند.
                    </p>
                    <form method="post" class="mt-5" action="{{route('projects.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating text-right">
                            <input required type="text" value="{{old('name')}}" id="name" placeholder="نام" name="name"
                                   class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <label class="text-right right" for="name" style="left: auto"> نام پروژه</label>
                        </div>

                        <div class="my-4">
                            <label for="formFile" class="form-label">
                                تصویر نشانه :
                            </label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>

                        <div class="form-group">
                            <div class="mb-2">
                                انتخاب اعضا :
                            </div>

                            <div class="list-group scroll-list">

                                @foreach($activeDesk->users as $user)

                                    @if ($user->id != $activeDesk->admin->id)
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" name="users[]" type="checkbox"
                                                   value="{{$user->id}}">
                                            {{$user->name}}
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        @foreach($errors->all() as $error)
                            <div class="">
                                <ul>
                                    <li class="text-danger small">{{$error}}</li>
                                </ul>
                            </div>

                        @endforeach

                        <div class="d-flex mt-3 justify-content-end align-items-center">

                            <div class="mx-1">
                                <a href="{{route('projects.index')}}" class="btn btn-outline-danger">لغو</a>
                            </div>
                            <div>
                                <button class="btn btn-outline-dark" type="submit">ایجاد پروژه جدید</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
