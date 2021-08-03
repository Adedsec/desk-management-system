<div class="card h-100">
    <div class="card-body p-0">
        <div class="list-group mx-0 p-0 ">
            <a href="{{route('desks.setting')}}" class="list-group-item list-group-item-action
            {{\Illuminate\Support\Facades\Route::currentRouteName()=='desks.setting' ? 'active' : ''}}">تنظیمات
                میزکار</a>
            <a href="{{route('users.index')}}" class="list-group-item list-group-item-action
            {{\Illuminate\Support\Facades\Route::currentRouteName()=='users.index' ? 'active' : ''}}">مدیریت اعضا</a>
            <a href="{{route('roles.index')}}" class="list-group-item list-group-item-action
            {{\Illuminate\Support\Facades\Route::currentRouteName()=='roles.index' ? 'active' : ''}}">مدیریت نقش ها و
                مجوز
                ها</a>
        </div>
    </div>

</div>
