@extends('panel.main')
@section('panel')
    <div class="card shadow ">
        <div class="card-header bg-white">
            لیست کاربران
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">نام</th>
                    <th scope="col">ایمیل</th>
                    <th scope="col">نقش ها</th>
                    <th scope="col">عملیات</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td> {{$user->name}} </td>
                        <td> {{$user->email}} </td>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge badge-secondary"> {{$role->persian_name}} </span>

                        @endforeach
                        <td><a href="{{route('users.edit',[$user->id])}}"> تغییر </a></td>
                    </tr>
                @empty
                    <p>
                        هیچ کاربری وجود ندارد
                    </p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
