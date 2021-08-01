@extends('panel.main')
@section('panel')
    <form method="post" action="{{route('users.update',$user->id)}}">
        @csrf

        <div class="form-group ">
            <span> افزودن نقش به کاربر </span>
            <hr>
        </div>
        <div class="form-group">
            @forelse ($roles as $role)
                <div class="custom-control custom-checkbox ">
                    <input type="checkbox" name='roles[]'
                           {{$user->roles->contains($role) ? 'checked' : ''}}
                           value="{{$role->name}}"
                           class="form-check-input" id="{{'role' . $role->id}}">
                    <label class="custom-control-label" for="{{'role' . $role->id}}">{{$role->persian_name}}</label>
                </div>
            @empty
                <p>
                    هیچ نقشی وجود ندارد
                </p>
            @endforelse
        </div>
        <div class="form-group mt-5">
            <span> افزودن دسترسی به کاربر </span>
            <hr>
        </div>
        <div class="form-group">
            @forelse ($permissions as $permission)
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" name='permissions[]'
                           {{$user->permissions->contains($permission) ? 'checked' : ''}} value="{{$permission->name}}"
                           class="form-check-input" id="{{'permission' . $permission->id}}">
                    <label class="custom-control-label"
                           for="{{'permission' . $permission->id}}">{{$permission->persian_name}}</label>
                </div>
            @empty
                <p>
                    هیچ دسترسی وجود ندارد
                </p>
            @endforelse
        </div>
        <div class="form-group mt-5">
            <button class="btn btn-outline-dark"> ثبت تغییرات</button>
        </div>
    </form>
@endsection
