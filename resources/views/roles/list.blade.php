@extends('panel.main')
@section('panel')
    <div class="card shadow">
        <div class="card-header bg-white">
            افزودن نقش
        </div>
        <div class="card-body">
            <form method="post" action="{{route('roles.store')}}">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="name" class="form-control  " placeholder=" نام نقش ">
                        @if($errors->has('name'))
                            <small class="form-text text-danger"> {{$errors->first('name')}} </small>
                        @endif
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="persian_name" class="form-control "
                               placeholder=" نام فارسی ">
                        @if($errors->has('persian_name'))
                            <small class="form-text text-danger"> {{$errors->first('persian_name')}} </small>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-dark">
                            @lang('افزودن نقش')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mt-5">
        <div class="card-header bg-white">
            نمایش نقش ها
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">نام</th>
                    <th scope="col"> نام فارسی</th>
                    <th scope="col"> عملیات</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td> {{$role->name}} </td>
                        <td> {{$role->persian_name}} </td>
                        <td><a href="{{route('roles.edit',$role->id)}}"> تغییر </a></td>
                    </tr>
                @empty
                    <p>
                        نقشی وجود ندارد
                    </p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
