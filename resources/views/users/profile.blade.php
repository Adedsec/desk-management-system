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
                        <a href="#updateModal" data-bs-toggle="modal" class="btn btn-outline-primary">تغییر اطلاعات</a>
                    </div>
                    <div>
                        <a href="{{route('auth.password.change.form')}}" class="btn mx-2 btn-outline-danger">تغییر
                            رمزعبور</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($user->joinRequests->isNotEmpty())
        <div class="row justify-content-center align-items-center">
            <div class="card w-50 mt-4">
                <div class="card-header bg-white">
                    درخواست های عضویت :
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>فرستنده</th>
                            <th>میزکار</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->joinRequests as $request)
                            <tr>
                                <td>{{$request->sender->name}}</td>
                                <td>{{$request->desk->name}}</td>
                                <td>{{$request->persianCreated()}}</td>
                                <td>
                                    <a href="{{route('desks.acceptRequest',$request->id)}}"
                                       class="btn btn-outline-dark">عضویت</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endif

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تغییر اطلاعات کاربر</h5>
                </div>
                <div class="modal-body">
                    <livewire:task.edit-user-form :user="$user"/>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function checkAvatar(e) {
            avatar_element = document.getElementById('avatar');
            if (e.checked == true) avatar_element.disabled = true;
            else avatar_element.disabled = false;
        }


    </script>

@endsection

