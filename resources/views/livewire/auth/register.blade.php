<div class=" container-fluid ">
    <div class="row mt-5 h-100 justify-content-center align-items-center">
        <div class="col-md-5 px-0  p-2 mx-0">
            <div class="card p-0 shadow">
                <div class="card-header bg-white">ثبت نام در میزکار</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">نام و نام خانوادگی
                                : </label>

                            <div class="col-md-6">
                                <input placeholder="نام و نام خانوادگی" id="name" wire:model.lazy='name' type="text"
                                       class="form-control p-1 @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">شماره تلفن
                                : </label>

                            <div class="col-md-6">
                                <input id="phone_number" placeholder="شماره تلفن" wire:model.lazy='phone_number'
                                       type="text"
                                       class="form-control p-1 @error('phone_number') is-invalid @enderror"
                                       name="phone_number" value="{{ old('phone_number') }}" required
                                       autocomplete="phone">

                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">آدرس ایمیل : </label>

                            <div class="col-md-6">
                                <input id="email" placeholder="ایمیل" type="email" wire:model.lazy='email'
                                       class="form-control p-1 @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">تصویر پروفایل : </label>

                            <div class="col-md-6">
                                <input id="file" type="file"
                                       class="form-control p-1 @error('avatar') is-invalid @enderror" name="avatar">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">رمز عبور : </label>

                            <div class="col-md-6">
                                <input placeholder="رمز عبور" id="password" type="password" wire:model.lazy='password'
                                       class="form-control p-1 @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تکرار رمزعبور
                                : </label>

                            <div class="col-md-6">
                                <input id="password-confirm" placeholder="تکرار رمز عبور"
                                       wire:model.lazy='password_confirmation' type="password"
                                       class="form-control p-1" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class=" d-flex justify-content-start mt-3 mb-0">
                            <div class="mx-1">
                                <button type="submit" class="btn btn-dark">
                                    ثبت نام
                                </button>
                            </div>
                            <div class="mx-1">
                                <button type="submit" class="btn text-light btn-danger">
                                    ورود با گوگل
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
