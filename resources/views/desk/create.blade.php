@extends('layouts.app')

@section('content')
    <div class="mt-5 w-auto ">
        <div class="row justify-content-center align-items-center">
            <div class="card w-50 shadow">
                <div class="card-header bg-white">
                    افزودن میزکار جدید
                </div>

                <div class="card-body">
                    <p class="card-title bg-white">
                        ایجاد میزِکار جدید یک محیط مستقل از میزکار فعلی شما که در حال حاضر عضو آن هستید، با مدیریت
                        خودتان ایجاد می‌کند و تنها شما به میزِکار جدید دسترسی خواهید داشت.
                    </p>
                    <form method="post" action="{{route('desks.store')}}">
                        @csrf
                        <div class="form-floating text-right">
                            <input type="text" id="name" placeholder="نام" name="name"
                                   class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <label class="text-right right" for="name" style="left: auto"> نام میزکار</label>
                        </div>

                        <div class="d-flex mt-3 justify-content-end align-items-center">

                            <div class="mx-1">
                                <button class="btn btn-outline-danger">لغو</button>
                            </div>
                            <div>
                                <button class="btn btn-outline-dark" type="submit">ایجاد میزکار جدید</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
