@extends('panel.main')
@section('panel')
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="card shadow">
                    <div class="card-header bg-white">
                        تغییر نام میزکار
                    </div>
                    <div class="card-body">

                        <form method="post" action="{{route('desks.update',$desk->id)}}">
                            @csrf
                            <div class="form-floating text-right">
                                <input type="text" id="name" value="{{$desk->name}}" placeholder="نام" name="name"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="text-right right" for="name" style="left: auto"> نام میزکار</label>
                            </div>

                            <div class="d-flex mt-4 justify-content-end align-items-center">

                                <div>
                                    <button class="btn btn-outline-dark" type="submit">تغییر نام</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row  mt-2">
                <div class="card shadow">
                    <div class="card-header bg-white">
                        حذف میزکار
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            در صورتیکه می‌خواهید میزِکار خود را حذف کنید، ابتدا تمامی اعضاء را حذف کرده سپس دکمه زیر را
                            انتخاب کنید: </p>
                        <div class="d-flex mt-4 align-items-center justify-content-end">
                            <a href="#" class="btn btn-outline-danger ">حذف میزکار</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header  bg-white">
                    دعوت عضو به میزکار
                </div>
                <div class="card-body">
                    <div class="row">

                        @if (!$desk->joinRequests->isEmpty())
                            <p class="card-text">
                                درخواست های فعال
                            </p>
                            <ul class="list-group scroll-list">
                                @foreach($desk->joinRequests as $request)
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center justify-content-around">
                                            <div class="">
                                                {{$request->user->name}}
                                            </div>
                                            <div>
                                                {{$request->user->email}}
                                            </div>
                                            <a href="{{route('desks.deleteRequest',$request->id)}}"
                                               class="link-primary">
                                                لغو درخواست
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="card-text">
                                درخواست فعالی موجود نیست !
                            </p>
                        @endif
                    </div>
                    <div class="row mt-3">

                        <form method="post" class="mb-3" action="{{route('desks.Send.request',$desk->id)}}">
                            @csrf
                            <div class="d-flex justify-content-start align-items-baseline">
                                <div class="w-50">
                                    <input type="text" name="email"
                                           class=" w-100 form-control w-50 @error('email') is-invalid @enderror"
                                           placeholder="ایمیل فرد مورد نظر خود را وارد کنید">
                                    @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-outline-primary mx-2">
                                    دعوت عضو جدید
                                </button>
                            </div>


                        </form>


                    </div>
                    <hr>

                </div>
            </div>
        </div>
    </div>
@endsection
