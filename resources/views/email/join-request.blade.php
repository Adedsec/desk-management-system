@component('mail::message')
    #پیوستن به میزکار

    کاربر {{$admin->name}}  شمارا به میز کار {{$desk->name}}  دعوت کرده است
    اطلاعات ورود شما به صورت زیر است :
    نام کاربری : ایمیل شما
    رمزعبور : {{$password}}
    @component('mail::button', ['url' => route('home')])
        ورود به میزکار
    @endcomponent

    باتشکر
    سیستم مدیریت پروژه میزکار
@endcomponent
