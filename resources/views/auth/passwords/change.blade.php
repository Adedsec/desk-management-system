@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow ">
                    <div class="card-header bg-white">ثبت رمز عبور جدید</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('auth.password.change') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="currentPassword"
                                       class="col-md-4 col-form-label text-md-right">آدرس ایمیل</label>

                                <div class="col-md-6">
                                    <input id="currentPassword" type="password"
                                           class="form-control p-1 @error('currentPassword') is-invalid @enderror"
                                           name="currentPassword"
                                           placeholder="رمزعبور فعلی" required
                                           autocomplete="email" autofocus>

                                    @error('currentPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">رمز عبور جدید</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control p-1 @error('password') is-invalid @enderror"
                                           name="password"
                                           placeholder="رمز عبور"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">تایید رمز عبور</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" placeholder="تکرار رمز عبور" type="password"
                                           class="form-control p-1"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark">
                                        ثبت رمز عبور جدید
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
