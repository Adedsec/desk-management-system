<ul class="nav nav-tabs shadow text-light" style="margin-left: -12px;margin-right: -12px">
    <li class="nav-item">
        <a class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'letters.input' ? 'active' : ''}} text-danger   "
           aria-current="page" href="{{route('letters.input')}}">صندوق ورودی</a>
    </li>
    <li class="nav-item ">
        <a class="nav-link  {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'letters.sent' ? 'active' : ''}}  text-danger"
           href="{{route('letters.sent')}}">صندوق خروجی</a>
    </li>
    <li class="nav-item ">
        <a class="nav-link  {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'letters.archive' ? 'active' : ''}}  text-danger"
           href="{{route('letters.archive')}}">آرشیو نامه ها</a>
    </li>

    <livewire:components.letter-tags-menu/>
</ul>
