<div class=" container-fluid ">
    <div class="row mt-5 h-100 justify-content-center align-items-center">
        <div class="col-md-5 px-0  p-2 mx-0">
            <div class="card p-0 shadow">
                <div class="card-header bg-white">ورود به میزکار</div>

                <div class="card-body">
                    <form method="POST" action="{{route('login')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">آدرس ایمیل</label>

                            <div class="col-md-6">
                                <input id="email" wire:model.lazy='email' type="email"
                                       class="form-control p-1 @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">رمز عبور</label>

                            <div class="col-md-6">
                                <input id="password" wire:model.lazy='password' type="password"
                                       class="form-control p-1 @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row p-1">
                            <div class="col-md-1">
                                <div class="form-check form-check-inline form-switch">
                                    <input class="form-check-input float-left" type="checkbox" name="remember"
                                           wire:model.lazy='remember'
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="col-md-4 mx-1">
                                <span class="">مرا به خاطر بسپار</span>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center justify-content-start mb-0">
                            <div class=" mx-1">
                                <button type="submit" class="btn btn-dark">
                                    ورود
                                </button>
                            </div>
                            <div class="mx-1">
                                <a href="{{route('auth.login.provider.redirect','google')}}" title="ورود با گوگل"
                                   class="btn text-light btn-danger">
                                    <i class="bi bi-google"></i>
                                </a>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('auth.password.forget.form') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
