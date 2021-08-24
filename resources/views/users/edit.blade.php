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
            <button class="btn btn-outline-dark"> ثبت تغییرات</button>
        </div>
    </form>
@endsection
