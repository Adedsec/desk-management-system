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
                            @foreach ($user->roles()->where('desk_id',\Illuminate\Support\Facades\Auth::user()->activeDesk->id)->get() as $role)
                                <span class="badge bg-info"> {{$role->persian_name}} </span>

                        @endforeach
                        <td>
                            <a class="btn btn-outline-success "
                               href="{{route('users.edit',[$user->id])}}">
                                تغییر
                            </a>

                            @if ($user->id != \Illuminate\Support\Facades\Auth::user()->activeDesk->admin_id)

                                <a class="btn btn-outline-danger "
                                   href="{{route('desk.user.delete',[\Illuminate\Support\Facades\Auth::user()->activeDesk->id,$user->id])}}">
                                    حذف
                                </a>

                            @endif

                        </td>
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
