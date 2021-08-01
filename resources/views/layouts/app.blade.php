<!doctype html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($title)
            {{$title}}
        @else
            میزکار
        @endisset
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <livewire:styles/>
</head>
<body>
<div id="app">
    @include('layouts.navigation')

    <main class=" container-fluid">

        @yield('content')

        @if (session('mustVerifyEmail'))

            <div class="alert position-fixed bottom-0 alert-warning alert-dismissible fade show" role="alert">
                ایمیل شما تایید نشده است لطفا ایمیل خود را تایید کنید <a class="link-danger"
                                                                         href="{{route('auth.email.send.verification')}}">ارسال
                    ایمیل
                    تاییدیه</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        @include('layouts.alert')
    </main>
</div>
<livewire:scripts/>
</body>
</html>
