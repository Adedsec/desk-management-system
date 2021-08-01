@component('mail::message')
    # verify your email

    Dear {{$name}}
    @component('mail::button', ['url' => $link])
        Verify Email
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
