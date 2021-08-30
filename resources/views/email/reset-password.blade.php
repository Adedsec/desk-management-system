@component('mail::message')
    # بازیابی رمزعبور

    برای ایجاد رمز عبور جدید روی دکمه زیر کلیک کنید !

    @component('mail::button', ['url' => $link])
        بازیابی
    @endcomponent

    با تشکر,
    سیستم مدیریت پروژه میزکار
@endcomponent
