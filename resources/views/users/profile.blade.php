@extends('layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="card w-50 mt-5">
            <div class="card-header bg-white">
                حساب کاربری
            </div>

            <div class="card-body">


                <div class="row">
                    <div class="col-md-2">
                        <img src="{{$user->getAvatar()}}" class="rounded-circle" width="120px" height="120px"
                             alt="profile picture">
                    </div>

                    <div class="col-md-10">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>نام : </strong>
                                    </div>

                                    <div>
                                        {{$user->name}}
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>ایمیل : </strong>
                                    </div>

                                    <div>

                                        @if ($user->hasVerifiedEmail())
                                            <span class="badge bg-success">تایید شده</span> {{$user->email}}
                                        @else
                                            <a href="{{route('auth.email.send.verification')}}" class="link-info">
                                                <span class="badge bg-info">تایید ایمیل</span>
                                            </a>{{$user->email}}
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>شماره تلفن : </strong>
                                    </div>

                                    <div>

                                        @if (is_null($user->phone_number))
                                            شماره شما ثبت نشده
                                        @else
                                            {{$user->phone_number}}
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class=" d-flex align-items-center justify-content-end mt-5">
                    <div>
                        <a href="" class="btn btn-outline-primary">تغییر اطلاعات</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
