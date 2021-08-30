@component('mail::message')
    # تایید ایمیل

    {{$name}}
    عزیز

    لطفا با کلیک بر روی لینک زیر ایمیل خود را تایید کنید
    @component('mail::button', ['url' => $link])
        تایید ایمیل
    @endcomponent

    باتشکر,
    سیستم مدیریت پروژه میزکار
@endcomponent
