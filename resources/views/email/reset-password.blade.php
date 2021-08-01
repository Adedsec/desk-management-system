@component('mail::message')
    # بازیابی رمزعبور

    The body of your message.

    @component('mail::button', ['url' => $link])
        بازیابی
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
